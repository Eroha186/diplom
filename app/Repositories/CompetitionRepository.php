<?php


namespace App\Repositories;


use App\Competition;
use App\ExpressCompetition;

class CompetitionRepository
{
    protected $field = [
      'nominations'
    ];

    const NUMBER_OF_PAGES_FOR_PAGINATION = 16;

    public function getAllRelevantCompetition()
    {
        return Competition::with($this->field)->where('status', 0)->get();
    }

    public function getAllRelevantCompetitionOrderBy($column, $orderByParam)
    {
        return Competition::with($this->field)->where('status', '0')->orderBy($column, $orderByParam)->paginate(self::NUMBER_OF_PAGES_FOR_PAGINATION);
    }

    public function getEndedCompetitions($column, $orderByParam)
    {
        return Competition::with($this->field)->where('status', '1')->orWhere('status', '2')->orderBy($column, $orderByParam)->paginate(self::NUMBER_OF_PAGES_FOR_PAGINATION);
    }

    public function getAllCompetition()
    {
        return Competition::all();
    }

    public function getCompetition($id)
    {
        return Competition::with($this->field)->where('id', $id)->first();
    }

    public function getCompetitionPrice($id)
    {
        return Competition::where('id', $id)->first()->price;
    }

    public function createCompetition($data)
    {
        $competition = Competition::create([
            'title' => $data['title'],
            'annotation' => $data['annotation'],
            'type_id' => (int)$data['type-competition'],
            'cover' => $this->uploadCover($data['cover']),
            'date_begin' => date('Y-m-d H:i:s', strtotime($data['date-begin'])),
            'date_end' => date('Y-m-d H:i:s', strtotime($data['date-end'])),
            'price' => (int)$data['price'],
            'substrate_id' => (int)$data['substrate'],
        ]);

        $this->attachmentNominationForCompetition($competition->id, $data['nominations']);

        return $competition;
    }


    ////////////////////////////////////////////////////////////////////////////////
    //////////                   Экспресс конкурсы                        //////////
    ////////////////////////////////////////////////////////////////////////////////

    public function getAllExpressCompetitions()
    {
        return ExpressCompetition::with($this->field)->get();
    }

    public function getExpressCompetition($id)
    {
        return ExpressCompetition::with($this->field)->where('id', $id)->get()->first();
    }

    public function createExpressCompetition($data)
    {
        $competition = ExpressCompetition::create([
            'title' => $data['title'],
            'annotation' => $data['annotation'],
            'type_id' => (int)$data['type-competition'],
            'cover' => $this->uploadCover($data['cover']),
            'substrate_id' => (int)$data['substrate'],
        ]);

        $this->attachmentNominationForExpressCompetition($competition->id, $data['nominations']);

        return $competition;
    }



    ////////////////////////////////////////////////////////////////////////////////
    //////////                 Вспомогательные методы                     //////////
    ////////////////////////////////////////////////////////////////////////////////


    protected function attachmentNominationForCompetition($competition_id, $nominations)
    {
        Competition::find($competition_id)->nominations()->attach($nominations);
    }

    protected function attachmentNominationForExpressCompetition($competition_id, $nominations)
    {
        ExpressCompetition::find($competition_id)->nominations()->attach($nominations);
    }

    protected function uploadCover($file)
    {
        return $file->store('upload', 'public');
    }
}