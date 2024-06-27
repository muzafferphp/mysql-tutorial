One To One
=================

A one-to-one relationship is a very basic relation. For example, a User model might have one Phone. We can define this relation in Eloquent

class User extends Model {
 
    public function phone()
    {
        return $this->hasOne('App\Phone');
    }
 
}

-----------

class Phone extends Model {
 
    public function user()
    {
        return $this->belongsTo('App\User', 'local_key');
    }
 
}