// Add the necessary imports
const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const session = require('express-session');

const app = express();
const PORT = process.env.PORT || 3000;

// Create MySQL connection
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'your_username',
  password: 'your_password',
  database: 'your_database'
});

//test
//9876543210 student
//2142142122 teacher
//1276543210 faculty
//1276543222 faculty

// Middleware
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(session({
  secret: 'secretkey',
  resave: true,
  saveUninitialized: true
}));

// Login route
app.post('/login', (req, res) => {
  const { username, password } = req.body;
  const query = 'SELECT * FROM users WHERE username = ? AND password = ?';
  connection.query(query, [username, password], (err, results) => {
    if (err) {
      console.error('Error executing SQL query:', err);
      res.status(500).json({ message: 'Internal server error' });
      return;
    }
    if (results.length > 0) {
      const user = results[0];
      req.session.user = user;
      res.json({ user });
    } else {
      res.status(401).json({ message: 'Invalid username or password' });
    }
  });
});

// Teacher dashboard route
app.get('/teacher/dashboard', (req, res) => {
  if (req.session.user && req.session.user.role === 'teacher') {
    // Handle teacher dashboard logic here
    res.send('Welcome to the teacher dashboard');
  } else {
    res.status(403).json({ message: 'Forbidden' });
  }
});

// Student dashboard route
app.get('/student/dashboard', (req, res) => {
  if (req.session.user && req.session.user.role === 'student') {
    // Handle student dashboard logic here
    res.send('Welcome to the student dashboard');
  } else {
    res.status(403).json({ message: 'Forbidden' });
  }
});

// Teacher CRUD operations
app.post('/teacher/add', (req, res) => {
  if (req.session.user && req.session.user.role === 'teacher') {
    // Handle adding a new teacher
  } else {
    res.status(403).json({ message: 'Forbidden' });
  }
});

app.put('/teacher/edit/:id', (req, res) => {
  if (req.session.user && req.session.user.role === 'teacher') {
    // Handle editing an existing teacher
  } else {
    res.status(403).json({ message: 'Forbidden' });
  }
});

app.delete('/teacher/delete/:id', (req, res) => {
  if (req.session.user && req.session.user.role === 'teacher') {
    // Handle deleting a teacher
  } else {
    res.status(403).json({ message: 'Forbidden' });
  }
});

// Student CRUD operations
app.post('/student/add', (req, res) => {
  if (req.session.user && req.session.user.role === 'teacher') {
    // Handle adding a new student
  } else {
    res.status(403).json({ message: 'Forbidden' });
  }
});

app.put('/student/edit/:id', (req, res) => {
  if (req.session.user && req.session.user.role === 'teacher') {
    // Handle editing an existing student
  } else {
    res.status(403).json({ message: 'Forbidden' });
  }
});

app.delete('/student/delete/:id', (req, res) => {
  if (req.session.user && req.session.user.role === 'teacher') {
    // Handle deleting a student
  } else {
    res.status(403).json({ message: 'Forbidden' });
  }
});

app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
