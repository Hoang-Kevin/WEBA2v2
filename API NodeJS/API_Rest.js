
const enumTable = require('./enumTable');
const bdd = require('./BDDConnect')
const express = require('express');
const bodyparser = require('body-parser')
const jsToken = require('njwt')
const secret = "5[:8j£NQ4Vcj"

// Nous définissons ici les paramètres du serveur.
const hostname = 'localhost';
const port = 3000;

// Nous créons un objet de type Express, et nous lui disons qu'on va manipuler du JSON.
var app = express();
app.use(bodyparser.json({ extended: true }))

//Afin de faciliter le routage (les URL que nous souhaitons prendre en charge dans notre API), nous créons un objet Router.
//C'est à partir de cet objet myRouter, que nous allons implémenter les méthodes.
var myRouter = express.Router();

//On defini les routes empruntable
myRouter.route(['/personnes', '/personnes/[0-9]+', '/inscrires', '/roles', '/produits', '/produits/[0-9]+', '/activites'])

      // GET
      .get(function (req, res) {

            //On recupere d'abord les informations de l'URL
            var path = req.path.split('/')
            var table = path[1]/*.split('?')[0]*/
            console.log(table)

            //On transforme le String "table" en Objet
            var tableObj = enumTable.table(table)

            //On recupere les parametres de l'URL
            var query = req.query
            var isQuery = Object.keys(query).length == 0 ? false : true

            var array = []
            if ((table == "produits" || table == "activites") && !req.headers.auth) {

                  //On execute la requête SQL et on recupere la reponse dans le tableau "array"
                  bdd.select(tableObj, query, isQuery)
                        .then(response => {
                              if (response.length) {
                                    for (let i = 0; i < response.length; i++) {
                                          array.push(response[i].dataValues)
                                    }
                              } else {
                                    array.push(response.dataValues)
                              }
                              res.json(array)
                        })

                        //En cas d'erreurs, on renvoie le status de la requête (pas opti ?)
                        .catch(() => {
                              res.status(res.statusCode).json({ status: "La page recherchée n'éxiste pas !" })
                        })
            } else {
                  //Code non effectué

                  console.log("eh non")
                  //       if (req.body.token) {
                  //             bdd.select(table, id)
                  //                   .then(response => {
                  //                         if (response.length) {
                  //                               for (let i = 0; i < response.length; i++) {
                  //                                     array.push(response[i].dataValues)
                  //                               }
                  //                         } else {
                  //                               array.push(response.dataValues)
                  //                         }
                  //                         res.json(array)
                  //                   })
                  //       } else {
                  //             res.json({ message: false })
                  //       }
            }
      })
      //POST
      .post(function (req, res) {

            //On recupere d'abord les informations de l'URL
            var path = req.path.split('/')
            var table = path[1]

            //On transforme le String "table" en Objet
            var tableObj = enumTable.table(table)

            //Si l'utilisateur souhaite se connecter, on lance la fonction "connect"
            if (req.query.connect == "true") {
                  console.log(req.body.adressemail)
                  connect(req, res)

            } else if (req.query.inscription == "true") {
                  console.log("inscription en cours")
                  //Si l'utilisateur veut d'inscrire, on l'ajoute dans la BDD
                  bdd.add(tableObj, req.body, res)
            } else {

                  //Si l'utilisateur possède un token, on ajoute les données a la table
                  if (req.body.token) {
                        console.log("salut")
                        bdd.add(tableObj, req.body, res)
                        //Sinon, on renvoie "accès refusé !"
                  } else {
                        res.json({ status: "Accès refusé !" })
                  }
            }
      })

      //PUT
      .put(function (req, res) {

            //On recupere d'abord les informations de l'URL
            var path = req.path.split('/')
            var table = path[1]

            //On transforme le String "table" en Objet
            var tableObj = enumTable.table(table)

            //si l'utilisateur possède un token, on modifie la table
            if (req.body.token) {
                  bdd.modify(tableObj, req.body, res)
            }
      })

      //DELETE
      .delete(function (req, res) {
            bdd.delete(enumTable.table(req.path.split('/')[1]), req.body)
            res.json({ message: "Suppression d'une piscine dans la liste", methode: req.method });
      });

// Nous demandons à l'application d'utiliser notre routeur
app.use(myRouter);

// Démarrer le serveur 
app.listen(port, hostname, function () {
      console.log("Mon serveur fonctionne sur http://" + hostname + ":" + port);
});


function connect(req, res) {
      var result = {}

      //On verifie si le mod de passe est correct
      bdd.connect(enumTable.table(req.path.split('/')[1]), req.body)
            .then(response => {
                  if (response) {
                        status = 200

                        //On recupere le role de l'utilisateur
                        bdd.verifRole(response.dataValues.adressemail)
                              .then(responseTest => {
                                    var { role, prenom, nom } = responseTest[0][0]
                                    const payload = { "mail": response.dataValues.adressemail }
                                    var token = jsToken.create(payload, secret, "HS256")
                                    token = token.compact()
                                    result.token = token
                                    result.role = role
                                    result.prenom = prenom
                                    result.nom = nom
                                    result.connect = true
                                    res.status(status).json(result)
                              })

                  } else {
                        res.json({ connect: false })
                  }
            })
}

// Pour l'instant on considère que le token se trouve dans le body
function decodeToken(token) {
      var decodedToken = jsToken.verify(token, secret, "HS256")
      decodedMail = decodedToken.body.mail
      return decodedMail;
}