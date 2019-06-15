<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Post extends Model implements Searchable
{
    protected $fillable = ['body','user_id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('categories.show', $this->id);

        return new SearchResult(
            $this,
            $this->body,
            $this->user_id,
            $url
        );
    }


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }
    public function retweets(){
        return $this->hasMany('App\Retweet');
    }
    public function retweetBy(){
        return $this->retweets()->where('user_id', $this->user_id);
    }

}
