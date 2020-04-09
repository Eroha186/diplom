<?php

namespace App\Http\Controllers\Admin;

use App\Events\RejectedWork;
use App\Publication;
use App\Repositories\PublicationRepository;
use App\Repositories\Works\WorkRepository;
use App\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfirmationController extends Controller
{
    public function __construct()
    {
        $this->publicationRepository = new PublicationRepository();
        $this->workRepository = new WorkRepository();
    }

    public function confirmPublication($id)
    {
        $this->publicationRepository->confirmPublication($id);

        return redirect(route('a-publication'));
    }

    public function rejectPublication($id)
    {
        $this->publicationRepository->rejectPublication($id);

        event(new RejectedWork($id, "publication"));

        return redirect(route('a-publication'));
    }

    public function confirmWork($competition_id, $id)
    {
        $this->workRepository->confirmWork($id);

        return redirect((route('a-competition', ['id' => $competition_id])));
    }

    public function rejectWork($id)
    {
        $this->workRepository->rejectWork($id);

        event(new RejectedWork($id, "competition"));

    }
}
