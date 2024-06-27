
1. Differences Between Normalization and Denormalization ?

=============================================================

Normalization is the method of arranging the data in the database efficiently. It involves constructing tables and setting up relationships between those tables according to some certain rules. The redundancy and inconsistent dependency can be removed using these rules in order to make it more flexible.

There are 6 defined normal forms: 1NF, 2NF, 3NF, BCNF, 4NF and 5NF. Normalization should eliminate the redundancy but not at the cost of integrity.

Denormalization is the inverse process of normalization, where the normalized schema is converted into a schema which has redundant information. The performance is improved by using redundancy and keeping the redundant data consistent. The reason for performing denormalization is the overheads produced in query processor by an over-normalized structure.


Normalization is the technique of dividing the data into multiple tables to reduce data redundancy and inconsistency and to achieve data integrity. On the other hand, Denormalization is the technique of combining the data into a single table to make data retrieval faster.


Normalization increases the number of tables and joins. In contrast, denormalization reduces the number of tables and join.

Disk space is wasted in denormalization because same data is stored in different places. On the contrary, disk space is optimized in a normalized table.


2. Explain 1NF, 2NF, 3NF in normolization in mysql
=====================================================================================


The First Normal Form – 1NF
For a table to be in the first normal form, it must meet the following criteria:

a single cell must not hold more than one value (atomicity)
there must be a primary key for identification
no duplicated rows or columns
each column must have only one value for each row in the table


The Second Normal Form – 2NF
The 1NF only eliminates repeating groups, not redundancy. That’s why there is 2NF.

A table is said to be in 2NF if it meets the following criteria:

it’s already in 1NF
has no partial dependency. That is, all non-key attributes are fully dependent on a primary key.


The Third Normal Form – 3NF
When a table is in 2NF, it eliminates repeating groups and redundancy, but it does not eliminate transitive partial dependency.

This means a non-prime attribute (an attribute that is not part of the candidate’s key) is dependent on another non-prime attribute. This is what the third normal form (3NF) eliminates.

So, for a table to be in 3NF, it must:
be in 2NF
have no transitive partial dependency.


Explin primary key foreign key, candidate key , unique key in mysql ?
=============================================================

Primary Key: Uniquely identifies each row in a table. Must be unique and not null. A table can have only one primary key.
Foreign Key: Establishes a link between two tables. It references the primary key of another table to enforce referential integrity.
Candidate Key: Any column (or a set of columns) that can uniquely identify a row in a table. A table can have multiple candidate keys, and one of them is selected as the primary key.
Unique Key: Ensures all values in the column (or set of columns) are unique. A table can have multiple unique keys, and they can contain NULL values.


What is trigger , How to create it ?
======================================================

A trigger in the context of databases, including MySQL, is a stored database object that automatically executes or "fires" in response to certain events or conditions occurring in the database. These events can include INSERT, UPDATE, DELETE operations on a table, or even database schema changes like CREATE, ALTER, or DROP statements.



Types of Triggers
BEFORE Triggers: These triggers fire before the triggering event (e.g., before an INSERT, UPDATE, or DELETE operation). They are often used for validation or modifying data before it's written to the table.

AFTER Triggers: These triggers fire after the triggering event. They are commonly used for auditing or logging purposes, or for actions that need to occur after data has been modified.



CREATE TRIGGER before_accommodation_types_insert
BEFORE INSERT ON accommodation_types
FOR EACH ROW
BEGIN
    SET NEW.created_at = CURRENT_TIMESTAMP;
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END




What is transection in mysql how to implement it ?
==============================================================

Transactions in MySQL are a group of logically related statements which will either be executed completely or no statement execution will occur. Atomicity, Consistency, Isolation, and Durability (ACID) are the properties of a MySQL transaction.


A transaction in MySQL is a sequence of one or more SQL operations (queries or commands) that are treated as a single logical unit of work. Transactions ensure that either all operations within the transaction are completed successfully and committed to the database, or none of them are.

START TRANSACTION;

-- SQL statements within the transaction
UPDATE accounts
SET balance = balance - 100
WHERE account_number = 'sender_account_number';

UPDATE accounts
SET balance = balance + 100
WHERE account_number = 'receiver_account_number';

INSERT INTO transactions (sender_account, receiver_account, amount, transaction_date)
VALUES ('sender_account_number', 'receiver_account_number', 100, NOW());

-- If everything is successful, commit the transaction
COMMIT;




What is index in my sql how to declear it ?
===============================================================

Indexes are used to retrieve data from the database more quickly than otherwise. The users cannot see the indexes, they are just used to speed up searches/queries.

In MySQL, an index is a data structure that improves the speed of data retrieval operations on a database table by providing quick access to rows based on the values of certain columns. Indexes are created on one or more columns of a table and are used by the database engine to quickly locate rows.

CREATE INDEX index_name ON table_name (column1, column2);



What is view How to create a view and drop in my sql ?
===========================================================

A MySQL View is a virtual table which is generated from a predefined SQL query. It contains (all or selective) records from one or more database tables. Views are not stored in a database physically, but they can still be dropped whenever not necessary.

In MySQL, a view is a virtual table derived from the result set of a SELECT query.

CREATE VIEW it_employees AS
SELECT employee_id, first_name, last_name
FROM employees
WHERE department_id = 'IT';


DROP VIEW it_employees;


What is table joine ?
============================

Table joins are used in SQL to combine rows from two or more tables based on a related column between them. The most common types of joins are:

INNER JOIN: Returns rows when there is at least one match in both tables.
LEFT JOIN (or LEFT OUTER JOIN): Returns all rows from the left table and matching rows from the right table.
RIGHT JOIN (or RIGHT OUTER JOIN): Returns all rows from the right table and matching rows from the left table.
FULL JOIN (or FULL OUTER JOIN): Returns all rows when there is a match in one of the tables.
CROSS JOIN: Returns the Cartesian product of the two tables.


SELECT columns
FROM table1
INNER JOIN table2 ON table1.column_name = table2.column_name;


SELECT columns
FROM table1
LEFT JOIN table2 ON table1.column_name = table2.column_name;


SELECT columns
FROM table1
RIGHT JOIN table2 ON table1.column_name = table2.column_name;


SELECT columns
FROM table1
FULL JOIN table2 ON table1.column_name = table2.column_name;


SELECT columns
FROM table1
CROSS JOIN table2;


More Complex Joins:
You can also perform more complex joins by joining multiple tables and adding additional conditions:

SELECT orders.order_id, orders.order_date, order_details.quantity, products.product_name
FROM orders
JOIN order_details ON orders.order_id = order_details.order_id
JOIN products ON order_details.product_id = products.product_id;


What is alias in sql ?
============================================
In SQL, an alias is a temporary name given to a table or column for the duration of a particular query. Aliases are often used to make column names more readable, to shorten table names when performing joins, or to avoid ambiguity when working with multiple tables that have columns with the same names.

SELECT e.employee_id, e.first_name, d.department_name
FROM employees AS e
JOIN departments AS d ON e.department_id = d.department_id;


OR 

SELECT e.employee_id, e.first_name, d.department_name
FROM employees e
JOIN departments d ON e.department_id = d.department_id;


Explain sub query with example ?
=====================================

A subquery, also known as an inner query or nested query, is a query embedded within another SQL query. The outer query is referred to as the main query, and the subquery is executed first, providing results to the main query. Subqueries can be used in various SQL clauses such as SELECT, FROM, WHERE, and HAVING.


SELECT employee_id, first_name, last_name
FROM employees
WHERE salary = (SELECT MAX(salary) FROM employees);


What is SQL?
==============
SQL stands for Structured Query Language
SQL lets you access and manipulate databases
SQL became a standard of the American National Standards Institute (ANSI) in 1986, and of the International Organization for Standardization (ISO) in 1987

What Can SQL do?
=====================
SQL can execute queries against a database
SQL can retrieve data from a database
SQL can insert records in a database
SQL can update records in a database
SQL can delete records from a database
SQL can create new databases
SQL can create new tables in a database
SQL can create stored procedures in a database
SQL can create views in a database
SQL can set permissions on tables, procedures, and views


What aggregate functions do you know?
==========================================
AVG() – returns the average value
SUM() – returns the sum of values
MIN() – returns the minimum value
MAX() – returns the maximum value
COUNT() – returns the number of rows, including those with null values
FIRST() – returns the first value from a column
LAST()– returns the last value from a column


 What is a view, and why use it?
 =================================
A virtual table containing a subset of data retrieved from one or more database tables (or other views). Views take very little space, simplify complex queries, limit access to the data for security reasons, enable data independence, and summarize data from multiple tables.



What is the difference between the DELETE and TRUNCATE statements?
=================================================================
DELETE is a reversible DML (Data Manipulation Language) command used to delete one or more rows from a table based on the conditions specified in the WHERE clause. Instead, TRUNCATE is an irreversible DDL (Data Definition Language) command used to delete all rows from a table. DELETE works slower than TRUNCATE. Also, we can't use the TRUNCATE statement for a table containing a foreign key.

What is the difference between the DROP and TRUNCATE statements?
==================================================================
DROP deletes a table from the database completely, including the table structure and all the associated constraints, relationships with other tables, and access privileges. TRUNCATE deletes all rows from a table without affecting the table structure and constraints. DROP works slower than TRUNCATE. Both are irreversible DDL (Data Definition Language) commands.


How to find the last id in a table?
=======================================
Using the MAX() function. Otherwise, in many SQL versions, we can use the following syntax:


SELECT id
FROM table_name
ORDER BY id DESC
LIMIT 1


What is Index in SQL?
=============================

With the help of Indexes, information retrieval from the database happens faster and with greater efficiency. Thus, indexes improve performance. There are three types of indexes:

Clustered: Used for reordering tables and searching information with key values.
Non-clustered: Used for maintaining the order of the tables.
Unique: They ban fields from having duplicate values.
There can be many non-clustered indexes in a table, however, there can be only one clustered index.


Are NULL values equal to zero?
==================================
No. NULL values show an absence of characters, whereas zero is a numerical value. NULL values occur when a character is unavailable or not known. NULL values should also not be confused with blank space because a blank space is not supposed to have any data attached to it, whereas a NULL value shows a data record without any value assigned to it.


What do you mean by ‘auto increment’?
==========================================
With the auto-increment command, one can generate unique numbers when new records are added to a table. This function is especially useful when one wants to automatically generate the primary key field values upon inserting new records. This command comes in handy on several platforms. The auto-increment command for the SQL servers is “identity”


What is a Primary Key?
=========================
A primary key is used to identify unique rows or tables in a database. Primary keys must always contain unique values. Null or duplicate values are not considered primary keys.


What is a Foreign Key?
=======================
A foreign key is used to link two or more tables together. Its values match with a primary key from a different table. Foreign keys are like references between tables.


What is a unique key?
===========================
A unique key ensures a table has a unique value not found or contained in other rows or columns. Unlike the primary key, the unique key may have multiple columns. You can create a unique key using the keyword "UNIQUE" when defining the table.


What is the difference between TRUNCATE and DELETE?
=======================================================
The truncate command is used when you want to delete all rows and values from a table. It is a DDL type of command which is faster. While the DELETE command is used when you want to delete a specific row in a table. It is a DML command type and less efficient than the truncate statement.


What is a cursor?
==================
A cursor is a temporary memory allocated by the server when performing any DML queries. They are used to store Database Tables. Basically a cursor in sql is an object in database code that allows processes to process rows one by one. While in other programming languages sets of data is processed individually through a loop, in SQL, data is processed in a set through a cursor.

Two types of cursors are Implicit cursors and Explicit cursors.

Implicit Cursors:
They are Default Cursors of SQL SERVER. Allocated when the user performs DML operations.

Explicit Cursors:
They are created by users in need. They are used for Fetching data from Tables in Row-By-Row Manner.


What is the difference between Local and Global variables?
========================================================
Local variables are used inside a function and can’t be reused by other functions, whereas global variables can be accessed and used throughout the program.


What is a subquery?
=========================
A subquery is a query that is found in another query. Usually referred to as an inner query, its output is typically used by another query.


What is ACID?
=======================

ACID in SQL refers to a set of properties that guarantee the reliable and consistent processing of database transactions. It is an acronym where each letter stands for one of the properties:

Atomicity: Ensures that a transaction is either fully completed or not executed at all. If any part of a transaction fails, the entire transaction is rolled back, and the database remains unchanged.

Consistency: Guarantees that the database transitions from one consistent state to another upon the completion of a transaction. All data must adhere to predefined rules and constraints.

Isolation: Provides a degree of separation between concurrent transactions, ensuring that they do not interfere with one other. It helps maintain data integrity by controlling the visibility of changes made by one transaction to another.

Durability: Guarantees that after a transaction has been committed, the modifications made to the database become permanent, even if a system failure or crash occurs.

ACID properties are vital in maintaining data integrity and consistency in relational database management systems (RDBMS) and ensuring the robustness of transactions.


What are triggers in SQL?
==============================
Triggers are special stored procedures that run when there's an event in the database server, such as changing data in a table. A trigger is different from a regular stored procedure as it cannot be directly called like a regular stored procedure.

What is a Clause?
======================
A clause is one of the SQL query statements that filters or customizes data for a query. It allows users to limit the results by providing a conditional statement to the query. It is typically used when a large amount of data is in the database.


Differentiate between HAVING and WHERE clauses
================================================
These conditions are used for searching values except that the HAVING clause is used with the SELECT statement accompanied by the GROUP BY clause. The HAVING clause is used in combination with the GROUP BY clause to filter the data based on aggregate values, while the WHERE clause is used to filter the data based on individual values.



What are DBMS and RDBMS?
==============================
DBMS – Database Management System.

DBMS is the software that allows storing, modifying, and retrieving data from a database. And it is a group of programs that act as the interface between data and applications. DBMS supports receiving queries from applications and retrieving data from the database.

RDBMS – Relational Database Management System

Like DBMS, RDBMS is also the software that allows storing, modifying, and retrieving data from a database but a RELATIONAL database. In a relational database, the data in the tables have a relationship. Besides, RDBMS is useful when data in tables are being managed securely and consistently.


Mention the different types of SQL commands or SQL subsets?
==============================================================
There are five types of SQL commands offered in SQL. They are given as follows;

DDL - Data Definition Languages
DML - Data Manipulation Languages
DCL - Data Control Language
TCL - Transaction Control Language
DQL - Data Query Language


What are the Various Commands used in SQL Subsets?
======================================================
DDL = CREATE, DROP, ALTER, TRUNCATE, ADD COLUMN, and DROP COLUMN
DML = INSERT, DELETE, and UPDATE
DCL = GRANT and REVOKE
TCL = COMMIT, ROLLBACK, SAVEPOINT, and SET TRANSACTION
DQL = SELECT


What is the difference between Index and View?
================================================

Generally, an index is created in a separate table. They are the pointers that indicate the address of data in a database table. An index helps speed up querying and the data retrieval process in a database.

On the other hand, a view is a virtual table created from the rows and columns of one or more tables. The main thing about a view is that the rows and columns are grouped logically. With the support of views, you can restrict access to the entire data in a database.

