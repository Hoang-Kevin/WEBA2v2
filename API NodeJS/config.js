const Sequelize = require('sequelize')

const dbName = 'WEBA2v2'
const username = 'root'
const password = ''
const host = 'localhost'
const dialect = 'mysql'

//On créer la connextion a la BDD
module.exports.sequelize = new Sequelize(dbName, username, password, {
    host: host,
    dialect: dialect
})