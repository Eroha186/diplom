<?php


namespace App\Repositories;


use App\Http\Controllers\UploadFileController;
use App\Publication;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PublicationRepository
{

    const NUMBER_OF_PAGES_FOR_PAGINATION = 10;

    protected $fields = [
        'user',
        'diplom',
        'type',
        'education',
        'themes',
        'kind',
        'files',
    ];

    /**
     * Получение всех публикаций авторизованного пользователя.
     *
     * @return mixed
     */
    public function getAllPublicationUser()
    {
        return $this->formatPublication(Publication::with($this->fields)->where('user_id', Auth::user()->id)->get());
    }

    /**
     * Получение всех подтвержденных публикаций.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllConfirmedPublications()
    {
        return Publication::with($this->fields)->where('moderation', 2)->paginate(PublicationRepository::NUMBER_OF_PAGES_FOR_PAGINATION);
    }

    public function getAllNotConfirmedPublications()
    {
        return Publication::with($this->fields)->where('moderation', 0)->paginate(PublicationRepository::NUMBER_OF_PAGES_FOR_PAGINATION);
    }

    public function getPublication($id)
    {
        return $this->attachFileUrlToPublication(Publication::with($this->fields)->where('id', $id)->get()->first());
    }

    /**
     * Создание публикации.
     *
     * @param $publication
     * @return mixed
     */
    public function createPublication($publication)
    {
        $filesId = $publication['filesId'];

      $themes = $publication['themes'];
      // if(count($publication['themes']) < 3) {
      //   echo 'Укажите не менее 3-ех тегов';
      //   exit;
      // }
        $publication = Publication::create([
            'user_id' => $publication['user_id'],
            'title' => $publication['title'],
            'annotation' => $publication['annotation'],
            'type_id' => $publication['type'],
            'kind_id' => $publication['kind'],
            'education_id' => $publication['education'],
            'text' => $publication['text'],
            'moderation' => 0,
            'date_add' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

       // echo '<pre>';
       // print_r($publication);
       // echo '</pre>';
       // die();
        $this->attachmentTheme($publication->id, $themes);
        $this->attachPublicationIdForFile($publication->id, $filesId);

        return $publication;
    }

    /**
     * Получение отсортированных потвержденных публикаций.
     *
     * @param $column
     * @param $orderByParam
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllConfirmedPublicationsOrderBy($column, $orderByParam)
    {
        return Publication::with($this->fields)->where('moderation', 2)->orderBy($column, $orderByParam)->paginate(PublicationRepository::NUMBER_OF_PAGES_FOR_PAGINATION);
    }

    public function confirmPublication($id)
    {
        Publication::where('id', $id)->update([
            'moderation' => 2,
        ]);
    }

    public function rejectPublication($id)
    {
        Publication::where('id', $id)->update([
            'moderation' => 1,
        ]);
    }


    ////////////////////////////////////////////////////////////////////////////////
    //////////                 Вспомогательные методы                     //////////
    ////////////////////////////////////////////////////////////////////////////////

    protected function attachPublicationIdForFile($publicationId, $files)
    {
        foreach ($files as $file) {
             (new UploadFileController())->attachPublicationIdForFile($file, $publicationId);
        }
    }

    /**
     * Форматирование вида публикации.
     *
     * @param $publications
     * @return mixed
     */
    protected function formatPublication($publications)
    {
        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['user']['i'] = mb_substr($publication['user']['i'], 0, 1);
            $publication['user']['o'] = mb_substr($publication['user']['o'], 0, 1);
            foreach ($publication['files'] as $file) {
                if ($file['type'] == 'doc') {
                    $publication['doc'] = 1;
                }
                if ($file['type'] == 'ppt') {
                    $publication['ppt'] = 1;
                }
            }
        }

        return $publications;
    }

    protected function attachFileUrlToPublication($publication)
    {

        $images = [];
        foreach ($publication['files'] as $file) {
            if ($file['type'] == 'doc' || $file['type'] == 'pdf') {
                $publication['doc'] = $file['url'];
            }
            if ($file['type'] == 'ppt') {
                $publication['ppt'] = $file['url'];
            }
            if ($file['type'] == 'image') {
                $images[] = $file['url'];
            }
        }

        $publication['images'] = $images;

        return $publication;
    }

    /**
     * Добавление тем к публикации.
     *
     * @param $publ_id
     * @param $themes
     */
    protected function attachmentTheme($publ_id, $themes)
    {
        $publication = Publication::find($publ_id);

        $publication->themes()->attach($themes);
    }
}