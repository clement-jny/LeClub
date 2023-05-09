//
//  JsonData.swift
//  LeClub
//
//  Created by Clément Jaunay on 29/03/2022.
//

import Foundation

//struct LeClub: Codable {
//    let historiques: [Historique]
//    let roles: [Role]
//    let sessions: [Session]
//    let sports: [Sport]
//    let utilisateurs: [Utilisateur]
//}

// MARK: - Resultat
struct Resultat: Codable {
    var code: Int
    var message: String
    
    static let empty = Resultat(code: 0, message: "")
}

// MARK: - Historique
struct Historique: Codable, Hashable {
    let hisSession, hisUtilisateur: Int
    let hisDate: String

    enum CodingKeys: String, CodingKey {
        case hisSession = "his_session"
        case hisUtilisateur = "his_utilisateur"
        case hisDate = "his_date"
    }
}

// MARK: - Role
struct Role: Codable {
    let rolID: Int
    let rolLibelle: String

    enum CodingKeys: String, CodingKey {
        case rolID = "rol_id"
        case rolLibelle = "rol_libelle"
    }
}

// MARK: - Session
struct Session: Codable {
    let sesID: Int
    let sesDate, sesHeure: String
    let sesSport: Int

    enum CodingKeys: String, CodingKey {
        case sesID = "ses_id"
        case sesDate = "ses_date"
        case sesHeure = "ses_heure"
        case sesSport = "ses_sport"
    }
}

// MARK: - Sport
struct Sport: Codable {
    let spoID: Int
    let spoLibelle: String
    let spoNbmax: Int

    enum CodingKeys: String, CodingKey {
        case spoID = "spo_id"
        case spoLibelle = "spo_libelle"
        case spoNbmax = "spo_nbmax"
    }
}

// MARK: - Utilisateur
struct Utilisateur: Codable {
    var utiID: Int
    var utiNom, utiPrenom, utiMail, utiMdp: String
    var utiRole: Int

    enum CodingKeys: String, CodingKey {
        case utiID = "uti_id"
        case utiNom = "uti_nom"
        case utiPrenom = "uti_prenom"
        case utiMail = "uti_mail"
        case utiMdp = "uti_mdp"
        case utiRole = "uti_role"
    }
}






//struct Result: Codable {
//    let code: Int
//    let message: String
//    let data: [Datum]
//}

// MARK: - Datum
//struct Datum: Codable {
//    let utiID: Int
//    let utiNom, utiPrenom, utiMail, utiMdp: String
//    let utiRole: Int
//
//    enum CodingKeys: String, CodingKey {
//        case utiID = "uti_id"
//        case utiNom = "uti_nom"
//        case utiPrenom = "uti_prenom"
//        case utiMail = "uti_mail"
//        case utiMdp = "uti_mdp"
//        case utiRole = "uti_role"
//    }
//}

//struct Datum: Codable {
//    let spoID: Int
//    let spoLibelle: String
//    let spoNbmax: Int
//
//    enum CodingKeys: String, CodingKey {
//        case spoID = "spo_id"
//        case spoLibelle = "spo_libelle"
//        case spoNbmax = "spo_nbmax"
//    }
//}
