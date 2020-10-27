<?php

use App\Education;
use App\Kind;
use App\Nomination;
use App\Theme;
use App\Type;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Tables for truncation.
     *
     * @var array
     */
    protected $truncatedTables = [
        User::class,
        Education::class,
        Nomination::class,
        Kind::class,
        Type::class,
        Theme::class,
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();
        $this->call(SeedUsers::class);
        $this->call(SeedWork::class);
        $this->call(SeedFile::class);
        $this->call(SeedNomination::class);
        $this->call(SeedNominationCompetition::class);
        $this->call(SeedCompetition::class);
        $this->call(SeedType_competition::class);
        $this->call(SeedPublications::class);
        $this->call(SeedEducations::class);
        $this->call(SeedKinds::class);
        $this->call(SeedTypes::class);
        $this->call(SeedThemes::class);
        $this->call(SeedExpressCompetition::class);
        $this->call(SeedExpressWork::class);
    }

    /**
     * Truncate tables.
     *
     * @return void
     */
    protected function truncateTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($this->truncatedTables as $table) {
            $table::truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
