<?php

namespace DvSoft\EloquentSearchable\Tests\Feature;

use DvSoft\EloquentSearchable\Tests\Models\EloquentUserModel;
use DvSoft\EloquentSearchable\Tests\TestCase;

class EloquentSearchableTest extends TestCase
{


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSearchInSearchableFieldsSuccess()
    {
        $this->createUsers();

        $searchedUser = EloquentUserModel::search('email.test')->get();
        $this->assertCount(2, $searchedUser);

        $searchedUser = EloquentUserModel::search('tonio')->get();
        $this->assertCount(1, $searchedUser);

        $searchedUser = EloquentUserModel::search('not exist')->get();
        $this->assertEmpty($searchedUser);

    }

    private function createUsers()
    {
        EloquentUserModel::create([
            'name'    => 'Giuseppe',
            'surname' => 'Esposito',
            'email'   => 'giuseppe@email.test',
        ]);

        EloquentUserModel::create([
            'name'    => 'Antonio',
            'surname' => 'Lo Cicero',
            'email'   => 'antonio@email.test',
        ]);

    }

    public function testSearchInNotSearchableFieldsSuccess()
    {
        $this->createUsers();

        $searchedUser = EloquentUserModel::search('Esposito')->get();
        $this->assertEmpty($searchedUser);

    }
}
