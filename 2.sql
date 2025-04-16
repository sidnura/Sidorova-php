select * from users;


SELECT *
FROM orders
WHERE user_id IN (
    SELECT id
    FROM users
    WHERE name LIKE '%Иванов%'
);


SELECT id, name
FROM users
WHERE id IN (
    SELECT user_id
    FROM orders
);


SELECT u.*, o.*
FROM orders o
JOIN users u ON o.user_id = u.id
WHERE o.created_at = (
    SELECT MAX(created_at)
    FROM orders
);


SELECT *
FROM orders
WHERE DATE(created_at) <= '2023-03-31';

