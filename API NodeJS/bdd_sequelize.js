const Sequelize = require('sequelize');

const sequelize = new Sequelize('projet web', 'root', '', {
    host: 'localhost',
    dialect: 'mysql'
});

const User = sequelize.define('utilisateurs', {
    // attributs
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true
    },
    nom: {
        type: Sequelize.STRING
        // allowNull defaults to true
    },
    prenom: {
        type: Sequelize.STRING,
    },
    mail: {
        type: Sequelize.STRING,
        allowNull: false
    },
    mdp: {
        type: Sequelize.STRING,
        allowNull: false
    },
    localisation: {
        type: Sequelize.STRING,
        allowNull: false
    }
});

// sequelize.authenticate()
//     .then(() => {
//         console.log('Connection has been established successfully.');
//     })
//     .catch(err => {
//         console.error('Unable to connect to the database:', err);
//     });


module.exports.select = function select() {
    return User.findAll({
        attributes: { exclude: ['createdAt', 'updatedAt'] }
    })// .then(users => {
    //     return JSON.stringify(users[0].dataValues)
    // });
}