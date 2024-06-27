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



4. Has One Through
============================

The "has-one-through" relationship defines a one-to-one relationship with another model. However, this relationship indicates that the declaring model can be matched with one instance of another model by proceeding through a third model.

For example, in a vehicle repair shop application, each Mechanic model may be associated with one Car model, and each Car model may be associated with one Owner model. While the mechanic and the owner have no direct relationship within the database, the mechanic can access the owner through the Car model. Let's look at the tables necessary to define this relationship:

mechanics
    id - integer
    name - string
 
cars
    id - integer
    model - string
    mechanic_id - integer
 
owners
    id - integer
    name - string
    car_id - integer


 Note :- As I have read documentation machine model have not any foreign key or relation ID So in that model written relationship function
 and make function name will be as have not related in the mode directly with of that table.

 ====================================

class Mechanic extends Model
{
    public function carOwner(): HasOneThrough
    {
        return $this->hasOneThrough(Owner::class, Car::class);
    }
}



class Car extends Model
{
    use HasFactory;

    protected $fillable = ['model', 'mechanic_id'];

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }

    public function owner()
    {
        return $this->hasOne(Owner::class);
    }
}



class Owner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'car_id'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}




5. Has Many Through
==========================

A "has many through" relationship is used to define a one-to-many relationship that is routed through an intermediate model. For example, consider the following scenario:

Each Country has many Users.
Each User has many Posts.
Using this, we can say that each Country has many Posts through the User.


countries
    id - integer
    name - string
 
users
    id - integer
    name - string
    country_id - integer
 
posts
    id - integer
    title - string
    user_id - integer



class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasManyThrough(Post::class, User::class);
    }
}



class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'country_id',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}



class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

