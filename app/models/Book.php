<?php

class Book extends Eloquent {
    protected $fillable =array('name','mark', 'mark_users','rank_id');
    public function rank(){
        return $this->belongsTo('Rank');
    }
}