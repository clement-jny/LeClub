//
//  HistoricalDetail.swift
//  LeClub
//
//  Created by Clément Jaunay on 01/04/2022.
//

import SwiftUI

struct HistoricalDetail: View {
    var historique: Historique
    
    var body: some View {
        Text("\(historique.hisSession) - \(historique.hisUtilisateur) - \(historique.hisDate)")
    }
}

struct HistoricalDetail_Previews: PreviewProvider {
    static let api = Api()
    
    static var previews: some View {
        HistoricalDetail(historique: api.historiques[0])
            .environmentObject(api)
    }
}
