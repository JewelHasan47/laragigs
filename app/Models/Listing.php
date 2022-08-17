<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model {
    use HasFactory;

    protected $fillable = [ 'title', 'user_id', 'logo', 'company', 'location', 'website', 'email', 'tags', 'description' ];

    /**
     * @param $query
     * @param array $filters
     * @return void
     */
    public function scopeFilter( $query, array $filters ): void {
        if( $filters[ 'tag' ] ?? false ) {
            $query->where( 'tags', 'like', '%' . request( 'tag' ) . '%' );
        }

        if( $filters[ 'search' ] ?? false ) {
            $query->where( 'title', 'like', '%' . request( 'search' ) . '%' )
                ->orWhere( 'description', 'like', '%' . request( 'search' ) . '%' )
                ->orWhere( 'tags', 'like', '%' . request( 'search' ) . '%' );
        }
    }

    // relationship to user
    public function user(): BelongsTo {
        return $this->belongsTo( User::class, 'user_id' );
    }
}
