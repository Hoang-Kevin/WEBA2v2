const connection = require('./config')
const Sequelize = require('sequelize')

//On créer les objets representants les tables de la BDD

module.exports.User = connection.sequelize.define('personnes', {
    id: {
        //Type du champ
        type: Sequelize.INTEGER,
        //Clé primaire
        primaryKey: true,
        //Auto increment
        autoIncrement: true
    },
    id_role_id: {
        type: Sequelize.STRING,
        //Clé étrangère
        foreignKey: true
    },
    nom: {
        type: Sequelize.STRING,
        allowNull: false
    },
    prenom: {
        type: Sequelize.STRING,
        allowNull: false
    },
    adressemail: {
        type: Sequelize.STRING,
        allowNull: false
    },
    motdepasse: {
        type: Sequelize.STRING,
        allowNull: false
    },
    localisation: {
        type: Sequelize.STRING,
        allowNull: false
    },
    campus: {
        type: Sequelize.STRING,
        allowNull: false
    }
}, {
    underscored: true,
    //
    timestamps: false
})

module.exports.Inscription = connection.sequelize.define('inscrires', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    id_activite_id: {
        type: Sequelize.INTEGER,
    },
    id_personne_id: {
        type: Sequelize.INTEGER,
    }
}, {
    timestamps: false
})

module.exports.Role = connection.sequelize.define('roles', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true,

    },
    name: {
        type: Sequelize.STRING,
        allowNull: false
    }
}, {
    timestamps: false
})

module.exports.Products = connection.sequelize.define('produits', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    id_categorie_id: {
        type: Sequelize.STRING,
        foreignKey: true
    },
    nom: {
        type: Sequelize.STRING,
        allowNull: false
    },
    prix: {
        type: Sequelize.FLOAT,
        allowNull: false
    },
    description: {
        type: Sequelize.STRING,
        allowNull: false
    },
    image: {
        type: Sequelize.STRING,
        allowNull: false
    }
}, {
    timestamps: false
})

module.exports.Activities = connection.sequelize.define('activites', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    nom: {
        type: Sequelize.STRING,
        allowNull: true,
    },
    description: {
        type: Sequelize.STRING,
        allowNull: true,
    },
    id_personne_id: {
        type: Sequelize.INTEGER,
        allowNull: true,
    },
    date: {
        type: Sequelize.DATE,
    },
    valide: {
        type: Sequelize.BOOLEAN,
    },
    image: {
        type: Sequelize.STRING,
        allowNull: true,
    },
    cout: {
        type: Sequelize.BOOLEAN,
        allowNull: true,
    },
    recurrence: {
        type: Sequelize.BOOLEAN,
        allowNull: true,
    },
}, {
    timestamps: false
})

module.exports.Commentaries = connection.sequelize.define('commentaries', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true,
    },
    users_id: {
        type: Sequelize.INTEGER,
        foreignKey: true,
        allowNull: true,
    },
    commentary: {
        type: Sequelize.STRING,
    }
}, {
    timestamps: false
})

module.exports.Components = connection.sequelize.define('components', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true,
    },
    users_id: {
        type: Sequelize.INTEGER,
        foreignKey: true,
        allowNull: true,
    },
    quantity: {
        type: Sequelize.INTEGER,
    }
}, {
    timestamps: false
})

module.exports.Components_orders = connection.sequelize.define('components_orders', {
    components_id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        foreignKey: true,
    },
    orders_id: {
        type: Sequelize.INTEGER,
        foreignKey: true,
        primaryKey: true,
    },
}, {
    timestamps: false
})

module.exports.Orders = connection.sequelize.define('orders', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true,
    },
    users_id: {
        type: Sequelize.INTEGER,
        foreignKey: true,
        allowNull: true,
    },
}, {
    timestamps: false
})

module.exports.Pictures = connection.sequelize.define('pictures', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true,
    },
    users_id: {
        type: Sequelize.INTEGER,
        allowNull: true,
    },
    activties_id: {
        type: Sequelize.INTEGER,
        allowNull: true,
    },
    url: {
        type: Sequelize.STRING,
    },
    description: {
        type: Sequelize.STRING,
    }
})

module.exports.Types = connection.sequelize.define('types', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true,
    },
    name: {
        type: Sequelize.STRING,
    }
})


module.exports.Votes = connection.sequelize.define('votes', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    users_id: {
        type: Sequelize.INTEGER,
        allowNull: true
    }
})
