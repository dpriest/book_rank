<?php

class Rank extends Eloquent {
    protected $fillable =array('name');
    public function books(){
        return $this->hasMany('Book');
    }
}