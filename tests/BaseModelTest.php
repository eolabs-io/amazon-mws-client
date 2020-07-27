<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsClient\Tests\Concerns\RequiresModelFactories;
use EolabsIo\AmazonMwsClient\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;

abstract class BaseModelTest extends TestCase
{
	use RefreshDatabase,
        RequiresModelFactories;

    /** @var string */
    public $modelClass;


    public function setUp(): void
    {
        parent::setUp();

        $this->seedDatabase();

        $this->modelClass = $this->getModelClass();
    }

    public function seedDatabase()
    {
        
    }

   /** @test */
    public function it_can_find_models()
    {
        $modelsInDb = $this->factory(10)->create();

        $models = $this->modelClass::All();

        $this->assertArraysEqual($models->toArray(), $modelsInDb->toArray());
    }

   /** @test */
    public function it_can_create_a_model()
    {
        $data = $this->factory()->make()->toArray();

        $model = $this->modelClass::create($data);
        $table = $model->getTable();
        
        $this->assertInstanceOf($this->modelClass, $model);
        $this->assertDatabaseHasModel($model);
    }

    /** @test */
    public function it_can_find_a_model()
    {
        $model = $this->factory()->create();
        $primaryKey = $this->getPrimaryKeyValue($model);

        $found = $this->modelClass::find($primaryKey);
        
        $this->assertInstanceOf($this->modelClass, $found);
        $this->assertEquals($found->toArray(), $model->toArray());
    }

    /** @test */
    public function it_can_update_a_model()
    {
        $model = $this->factory()->create();
        $table = $model->getTable();
        $data = $this->removePrimaryKeyFromModel( $this->factory()->make() );

        $update = $model->update($data);

        $this->assertTrue($update);
        $this->assertDatabaseHasModel($model);
    }


    /** @test */
    public function it_can_delete_a_model()
    {
        $model = $this->factory()->create();
        $table = $model->getTable();

        $model->delete();

        $this->assertDatabaseMissing($table, $model->toArray());
    }

    // Helpers //
    public function assertArraysEqual($array1, $array2){

        $sortedArray1 = Arr::sortRecursive($array1);
        $sortedArray2 = Arr::sortRecursive($array2);

        // return
        $this->assertEquals($sortedArray1, $sortedArray2);
    }

    public function assertDatabaseHasModel(Model $model)
    {
        $found = $this->modelClass::find($model->id);
        $this->assertEquals($found->toArray(), $model->toArray());
    }
}