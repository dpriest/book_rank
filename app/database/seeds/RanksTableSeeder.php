<?php
/**
 * Created by PhpStorm.
 * User: zhangwenhao <zhangwenhao@ganji.com>
 * Date: 12/12/14
 * Time: 23:43
 */
class RanksTableSeeder extends Seeder {
    public function run(){
        DB::table('ranks')->insert(array(
            array('id'=>1, 'name'=>"Domestic"),
            array('id'=>2, 'name'=>"Persian"),
            array('id'=>3, 'name'=>"Siamese"),
            array('id'=>4, 'name'=>"Abyssinian"),
        ));
    }
}