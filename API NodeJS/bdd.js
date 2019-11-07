var mysql = require('mysql');
var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'projet web'
});

connection.connect(function (err) {
    if (err) {
        console.error('error connecting: ' + err.stack);
        return;
    }

    console.log('connected as id ' + connection.threadId);
});

module.exports.maquery = connection.query("SELECT * FROM utilisateurs", (errors, result, fields) => {
    console.log(result)
    //return result
})
