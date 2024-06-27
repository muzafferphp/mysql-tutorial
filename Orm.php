1. One To One
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



2. One To Many
==========================
An example of a one-to-many relation is a blog post that "has many" comments. We can model this relation like so:

class Post extends Model {
 
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
 
}


class Comment extends Model {
 
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
 
}


3. Many To Many
=========================

In Laravel, many-to-many relationships are implemented using pivot tables. These tables serve as intermediaries between two related tables and typically contain only the foreign keys of the related tables.

Example Scenario
Let's assume you have User and Role models where each user can have multiple roles and each role can be assigned to multiple users.


class User extends Authenticatable
{

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}


class Role extends Model
{

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

