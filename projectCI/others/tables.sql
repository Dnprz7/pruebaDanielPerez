-- Active: 1709003572370@@localhost@3306@projectci
#EDUCATIONAL PURPOSES

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) not NULL, email VARCHAR(255) UNIQUE not NULL, password VARCHAR(255) not NULL, role ENUM(
        'administrator', 'regular_user'
    ) DEFAULT 'regular_user'
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), description TEXT, start_date DATE
);

ALTER TABLE projects
ADD COLUMN user_id INT,
ADD CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY, project_id INT, name VARCHAR(255), description TEXT, due_date DATE, status ENUM(
        'pending', 'in_progress', 'completed'
    ) DEFAULT 'pending', FOREIGN KEY (project_id) REFERENCES projects (id) ON DELETE CASCADE
);

INSERT INTO
    users
VALUES (
        null, '$name', '$email', '$passwordEncrypted'
    );

SELECT p.* FROM projects p ORDER BY p.id DESC;

SELECT p.*, t.name, t.description, t.due_date, t.status
FROM projects p
    LEFT JOIN tasks t ON p.id = t.project_id
WHERE
    p.id = 1;

SELECT p.*, t.*
FROM projects p
    LEFT JOIN tasks t ON p.id = t.project_id
WHERE
    p.id = 1;

SELECT t.*, p.name AS 'Project Name'
FROM tasks t
    JOIN projects p ON t.project_id = p.id
WHERE
    p.id = 1;

SELECT t.*, p.name AS 'project'
FROM tasks t
    INNER JOIN projects p ON t.project_id = p.id
WHERE
    t.project_id = 2
ORDER BY t.id DESC;

SELECT t.*, p.name AS 'Project Name'
FROM tasks t
    JOIN projects p ON t.project_id = p.id
WHERE
    p.id = 2
ORDER BY t.id DESC;

SELECT t.*, p.name AS 'project'
FROM tasks t
    INNER JOIN projects p ON t.project_id = t.id
WHERE
    t.project_id = 1;

SELECT t.*, p.name AS 'project'
FROM tasks t
    JOIN projects p ON t.project_id = p.id
WHERE
    p.id = 1;

SELECT * FROM projects WHERE id = 8;

SELECT MONTHNAME(start_date) AS month, COUNT(*) AS project_count
FROM projects
WHERE
    YEAR(start_date) = YEAR(CURRENT_DATE())
GROUP BY
    MONTH(start_date)
ORDER BY MONTH(start_date)

SELECT p.name AS project_name, COUNT(t.id) AS task_count
FROM projects p
    JOIN tasks t ON p.id = t.project_id
GROUP BY
    p.id
ORDER BY task_count DESC;

SELECT COUNT(*) AS pending_count
FROM tasks
WHERE
    status = 'pending';

SELECT COUNT(*) AS in_progress_count
FROM tasks
WHERE
    status = 'in_progress';

SELECT COUNT(*) AS completed_count
FROM tasks
WHERE
    status = 'completed';

SELECT
    p.name AS project_name,
    t.name AS task_title,
    t.status AS task_status
FROM projects p
    LEFT JOIN tasks t ON p.id = t.project_id
ORDER BY p.id, t.id