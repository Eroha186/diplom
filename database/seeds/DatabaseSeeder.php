<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(SeedUsers::class);
//        $this->call(SeedWork::class);
        $this->call(SeedFile::class);
//        $this->call(SeedNomination::class);
//        $this->call(SeedNominationCompetition::class);
//        $this->call(SeedCompetition::class);
//        $this->call(SeedType_competition::class);
        $this->call(SeedPublications::class);
//        $this->call(SeedEducations::class);
//        $this->call(SeedKinds::class);
//        $this->call(SeedTypes::class);
//        $this->call(SeedThemes::class);
    }
}
