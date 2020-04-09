<?php


namespace App\Repositories;


use App\Competition;
use App\ExpressCompetition;

class CompetitionRepository
{
    public function getAllRelevantCompetition()
    {
        return Competition::where('status', 0)->get();
    }

    public function getAllCompetition()
    {
        return Competition::all();
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
            'substrate_id' => (int)$data['substrate'],
        ]);

        $this->attachmentNominationForCompetition($competition->id, $data['nominations']);

        return $competition;
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

    protected function attachmentNominationForCompetition($competition_id, $nominations)
    {
        Competition::find($competition_id)->nomination()->attach($nominations);
    }

    protected function attachmentNominationForExpressCompetition($competition_id, $nominations)
    {
        ExpressCompetition::find($competition_id)->nomination()->attach($nominations);
    }

    protected function uploadCover($file)
    {
        return $file->store('upload', 'public');
    }
}