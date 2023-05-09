//
//  Sport.swift
//  LeClub
//
//  Created by Clément Jaunay on 29/03/2022.
//

import Foundation

//Identifiable
struct Sport: Codable, Hashable {
    var spo_id: Int
    var spo_libelle: String
    var spo_nbmax: Int
}
