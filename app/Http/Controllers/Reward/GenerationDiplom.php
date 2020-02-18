<?php

namespace App\Http\Controllers\Reward;

use App\Competition;
use App\ExpressCompetition;
use App\ExpressWork;
use App\Http\Controllers\Controller;
use App\Publication;
use App\Substrate;
use App\User;
use App\Work;
use App\Diplom;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GenerationDiplom extends Controller
{
    private $regular = "font/roboto/Roboto-Regular.ttf";
    private $bold = "font/roboto/Roboto-Bold.ttf";
    private $light = "font/roboto/Roboto-Light.ttf";
    private $italic = "font/roboto/Roboto-Italic.ttf";

    public function generate($typeWork, $workId)
    {
        $work = [];
        $substrate = [];
        $diplomId = Diplom::where(
            [
                ['work_id', '=', $workId],
                ['type', '=', $typeWork]
            ])->first();
        $stamp = asset(Storage::url('substrates/stamp.png'));
        $aboutPublishing = asset(Storage::url('substrates/publication.png'));
        switch ($typeWork) {
            case "publication":
                $work = Publication::with('author')->where('id', $workId)->first();
                $substrate['url'] = "substrates/weHnrngpLrHsUUfAFKoj7kUUjCt5woqAbPtmpGad.jpeg";
                $diplom = asset(Storage::url('substrates/certificate.png'));
                break;
            case "work":
                $work = Work::with('user')->where('id', $workId)->first();
                $substrateId = Competition::select('substrate_id')->where('id', $work['competition_id'])->first();
                $substrateId = $substrateId['substrate_id'];
                $substrate = Substrate::select('url')->where('id', $substrateId)->first();
                $diplom = asset(Storage::url('substrates/diplom.png'));
                $competition = Competition::select('title')->where('id', $work->competition_id)->first();
                break;
            case "expressWork":
                $work = ExpressWork::with('user')->where('id', $workId)->first();
                $substrateId = ExpressCompetition::select('substrate_id')->where('id', $work->competition_id)->first();
                $substrateId = $substrateId['substrate_id'];
                $substrate = Substrate::select('url')->where('id', $substrateId)->first();
                $substrate['url'] = "substrates/weHnrngpLrHsUUfAFKoj7kUUjCt5woqAbPtmpGad.jpeg";
                $diplom = asset(Storage::url('substrates/diplom.png'));
                $competition = ExpressCompetition::select('title')->where('id', $work->competition_id)->first();
                break;
        }

        $user = User::where('id', $work->user_id)->first();
        $img = Image::make(asset(Storage::url($substrate['url'])));
        $x = round($img->width() / 2); // позиция по х
        $y = 450; // стартовая позиция по у
        if ($typeWork === "publication") {
            $img->insert($diplom, 'top', $x, $y);
            $y += 160;
            $img->insert($aboutPublishing, 'top', $x, $y);
            $y += 120;
            $img->text('Настоящее свидетельство подтверждает, что', $x, $y, function ($font) {
                $font->file($this->regular);
                $font->size(32);
                $font->align('center');
            });
            $y += 70;
            $img->text($user->f . ' ' . $user->i . ' ' . $user->o, $x, $y, function ($font) {
                $font->file($this->bold);
                $font->size(48);
                $font->align('center');
                $font->color('#328398');
            });
            $y += 50;
            $str = $user->stuff;
            if (strlen($str) > 70) {
                foreach ($this->lineBreak($str, $y, "stuff", $user->town) as $key => $item) {
                    $img->text($item, $x, $key, function ($font) {
                        $font->file($this->regular);
                        $font->size(26);
                        $font->align('center');
                    });
                    $y = $key;
                }
            } else {
                $str = $str . ', г.' . $user->town;
                $img->text($str, $x, $y, function ($font) {
                    $font->file($this->regular);
                    $font->size(26);
                    $font->align('center');
                });
            }
            $y += 70;
            $img->text("Опубликовал(а) материал на педагагическом портале \"Современный педагог\"", $x, $y, function ($font) {
                $font->file($this->regular);
                $font->size(32);
                $font->align('center');
            });
            $y += 60;
            $example = $y + 40; // переменная для использования в ниже стоящем цикле
            foreach ($this->lineBreak($work->title, $y) as $key => $item) {
                if ($key == $example) {
                    $img->text("Работа: " . $item, $x, $key, function ($font) {
                        $font->file($this->bold);
                        $font->size(32);
                        $font->align('center');
                        $font->color('#328398');
                    });
                } else {
                    $img->text($item, $x, $key, function ($font) {
                        $font->file($this->bold);
                        $font->size(32);
                        $font->align('center');
                        $font->color('#328398');
                    });
                }
                $y = $key;
            }
            $y += 130;
            $img->text("www.diploma.fvds.ru/" . $typeWork . "/" .
                ($typeWork === "competition" ? $work->competition_id . "/work/" . $work->id : $work->id),
                $x, $y, function ($font) {
                    $font->file($this->light);
                    $font->size(26);
                    $font->align('center');
                });
            $y += 50;
            $img->text("№ " . $this->numberZero($diplomId->id), $x, $y, function ($font) {
                $font->file($this->regular);
                $font->size(35);
                $font->align('center');
            });
            $y += 200;
            $img->text("Руководитель проекта", $x - ($x * 0.65), $y, function ($font) {
                $font->file($this->regular);
                $font->size(28);
                $font->align('left');
            });
            $y += 30;
            $img->text("Левочко М.О.", $x - ($x * 0.65), $y, function ($font) {
                $font->file($this->regular);
                $font->size(28);
                $font->align('left');
            });
            $img->insert($stamp, "top-left", $x - 130, ($y - 180));

            $img->text($this->month(), $x + round($x * 0.5), $y - 15, function ($font) {
                $font->file($this->regular);
                $font->size(28);
                $font->align('center');
            });
            $y += 150;
            $img->text("Тут верхняя строчка про проект", $x, $y, function ($font) {
                $font->file($this->light);
                $font->size(22);
                $font->align('center');
            });
            $y += 25;
            $img->text("Тут нижняя строчка про проект", $x, $y, function ($font) {
                $font->file($this->light);
                $font->size(22);
                $font->align('center');
            });
            $y += 50;
            $img->text("www.diploma.fvds.ru", $x, $y, function ($font) {
                $font->file($this->bold);
                $font->size(32);
                $font->align('center');
            });
        } elseif ($typeWork === "work" || $typeWork === 'expressWork') {
            $img->insert($diplom, 'top', $x, $y);
            $y += 200;
            $img->text('Награждается', $x, $y, function ($font) {
                $font->file($this->regular);
                $font->size(32);
                $font->align('center');
            });
            $y += 70;
            if ($work->ic !== null && $work->fc !== null && $work->oc !== null) {
                $img->text($work->fc . ' ' . $work->ic . ' ' . $work->oc, $x, $y, function ($font) {
                    $font->file($this->bold);
                    $font->size(48);
                    $font->align('center');
                    $font->color('#328398');
                });
            } else {
                $img->text($user->f . ' ' . $user->i . ' ' . $user->o, $x, $y, function ($font) {
                    $font->file($this->bold);
                    $font->size(48);
                    $font->align('center');
                    $font->color('#328398');
                });
            }
            $y += 50;
            $str = $user->stuff;
//            $str = Str::random(10) . ' ' . Str::random(30) . ' ' . Str::random(20) . ' ' . Str::random(30);
            if (strlen($str) > 70) {
                foreach ($this->lineBreak($str, $y, "stuff", $user->town) as $key => $item) {
                    $img->text($item, $x, $key, function ($font) {
                        $font->file($this->regular);
                        $font->size(26);
                        $font->align('center');
                    });
                    $y = $key;
                }
            } else {
                $str = $str . ', г.' . $user->town;
                $img->text($str, $x, $y, function ($font) {
                    $font->file($this->regular);
                    $font->size(26);
                    $font->align('center');
                });
            }
            $y += 120;
            switch ($work->place) {
                case "1":
                    $img->text("Победитель (1-е место)", $x, $y, function ($font) {
                        $font->file($this->bold);
                        $font->size(70);
                        $font->align('center');
                        $font->color('#328398');
                    });
                    break;
                case "2":
                    $img->text("Победитель (2-е место)", $x, $y, function ($font) {
                        $font->file($this->bold);
                        $font->size(70);
                        $font->align('center');
                        $font->color('#328398');
                    });
                    break;
                case "3":
                    $img->text("Победитель (3-е место)", $x, $y, function ($font) {
                        $font->file($this->bold);
                        $font->size(70);
                        $font->align('center');
                        $font->color('#328398');
                    });
                    break;
                case "4":
                    $img->text("Участник", $x, $y, function ($font) {
                        $font->file($this->bold);
                        $font->size(70);
                        $font->align('center');
                        $font->color('#328398');
                    });
                    break;
            }
            $y += 60;
            $img->text("всероссийского творческого конкурса", $x, $y, function ($font) {
                $font->file($this->regular);
                $font->size(32);
                $font->align('center');
            });
            $y += 60;
            $img->text($competition->title, $x, $y, function ($font) {
                $font->file($this->bold);
                $font->size(32);
                $font->align('center');
                $font->color('#328398');
            });
            $y += 40;
            $example = $y + 40; // переменная для использования в ниже стоящем цикле
            foreach ($this->lineBreak($work->title, $y) as $key => $item) {
                if ($key == $example) {
                    $img->text("Работа: " . $item, $x, $key, function ($font) {
                        $font->file($this->bold);
                        $font->size(32);
                        $font->align('center');
                        $font->color('#328398');
                    });
                } else {
                    $img->text($item, $x, $key, function ($font) {
                        $font->file($this->bold);
                        $font->size(32);
                        $font->align('center');
                        $font->color('#328398');
                    });
                }
                $y = $key;
            }

            if ($work->ic !== null && $work->fc !== null && $work->oc !== null) {
                $y += 80;
                $img->text("Куратор: " . $user->f . ' ' . $user->i . ' ' . $user->o, $x, $y, function ($font) {
                    $font->file($this->regular);
                    $font->size(26);
                    $font->align('center');
                });
            }
            if ($typeWork !== "e-competition") {
                $y += 130;
                $img->text("www.diploma.fvds.ru/" . $typeWork . "/" .
                    ($typeWork === "competition" ? $work->competition_id . "/work/" . $work->id : $work->id),
                    $x, $y, function ($font) {
                        $font->file($this->light);
                        $font->size(26);
                        $font->align('center');
                    });
            }
            $y += 50;
            $img->text("№ " . $this->numberZero($diplomId->id), $x, $y, function ($font) {
                $font->file($this->regular);
                $font->size(35);
                $font->align('center');
            });
            $y += 200;
            $img->text("Руководитель проекта", $x - ($x * 0.65), $y, function ($font) {
                $font->file($this->regular);
                $font->size(28);
                $font->align('left');
            });
            $y += 30;
            $img->text("Левочко М.О.", $x - ($x * 0.65), $y, function ($font) {
                $font->file($this->regular);
                $font->size(28);
                $font->align('left');
            });
            $img->insert($stamp, "top-left", $x - 130, ($y - 180));

            $img->text($this->month(), $x + round($x * 0.5), $y - 15, function ($font) {
                $font->file($this->regular);
                $font->size(28);
                $font->align('center');
            });
            $y += 150;
            $img->text("Тут верхняя строчка про проект", $x, $y, function ($font) {
                $font->file($this->light);
                $font->size(22);
                $font->align('center');
            });
            $y += 25;
            $img->text("Тут нижняя строчка про проект", $x, $y, function ($font) {
                $font->file($this->light);
                $font->size(22);
                $font->align('center');
            });
            $y += 50;
            $img->text("www.diploma.fvds.ru", $x, $y, function ($font) {
                $font->file($this->bold);
                $font->size(32);
                $font->align('center');
            });
        }
        return $img->response();
    }

    private function month()
    {
        $date = date("d F Y");
        $date = explode(' ', $date);
        $month = $date[1];
        switch ($month) {
            case "January":
                $month = "января";
                break;
            case "February":
                $month = "февраля";
                break;
            case "March":
                $month = "марта";
                break;
            case "April":
                $month = "апреля";
                break;
            case "May":
                $month = "мая";
                break;
            case "June":
                $month = "июня";
                break;
            case "July":
                $month = "июля";
                break;
            case "August":
                $month = "августа";
                break;
            case "September":
                $month = "сентября";
                break;
            case "October":
                $month = "октября";
                break;
            case "November":
                $month = "ноября";
                break;
            case "December":
                $month = "декабря";
                break;
        }
        $date[1] = $month;
        return implode(" ", $date);
    }

    private function numberZero($number)
    {
        switch (strlen($number)) {
            case "1":
                $number = "000000" . $number;
                break;
            case "2":
                $number = "00000" . $number;
                break;
            case "3":
                $number = "0000" . $number;
                break;
            case "4":
                $number = "000" . $number;
                break;
            case "5":
                $number = "00" . $number;
                break;
            case "6":
                $number = "0" . $number;
                break;
        }
        return $number;
    }

    private function lineBreak($str, $y, $type = '', $town = '')
    {
        $str = explode(' ', $str);
        $i = 0;
        $str_array = [];
        $str_new = '';
        $flag = false;
        while ($i < count($str)) {
            $y += 40;
            $j = 1;
            if (strlen($str[$i]) >= 65 && strlen($str[$i]) <= 70) {
                $str_new = $str[$i];
            } elseif (strlen($str[$i]) < 65) {
                if ($i == count($str) - 1) {
                    if ($type == 'stuff') {
                        $str_new = $str[$i];
                    } else {
                        if (strlen($str[$i] . ' ' . $str[$i - 1]) < 70) {
                            $str_array[$y - 40] .= ' ' . $str[$i];
                            $flag = true;
                        } else {
                            $str_new = $str[$i];
                        }
                    }
                } else {
                    $str_new = $str[$i] . ' ' . $str[$i + $j];
                    while (strlen($str_new) < 70) {
                        $j++;
                        if ($i >= count($str) - 1) {
                            break;
                        }
                        if ($i + $j >= count($str) - 1) {
                            break;
                        }
                        if (strlen($str_new . ' ' . $str[$i + $j]) >= 70) {
                            break;
                        } else {
                            $str_new = $str_new . ' ' . $str[$i + $j];
                        }
                    }
                }
            }
            if ($i == count($str) - 1 && $town !== '') {
                $str_new .= ', г.' . $town;
            }
            if (!$flag) {
                $str_array[$y] = $str_new;
            }
            $i += $j;
        }
        return $str_array;
    }
}
