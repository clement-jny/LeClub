//
//  HistoricalList.swift
//  LeClub
//
//  Created by Clément Jaunay on 01/04/2022.
//

import SwiftUI

struct HistoricalList: View {
    @EnvironmentObject var api: Api
    var utilisateur: Utilisateur
    
    var body: some View {
        
        List {
            
            ForEach(api.historiques, id:\.self) { historique in
                
                if historique.hisUtilisateur == utilisateur.utiID {
                    
                    Text(Date().convertDateTimeToFr(historique.hisDate))
                    
//                    NavigationLink {
//                        HistoricalDetail(historique: historique)
//                    } label: {
//                        Text(Date().convertDateTimeToFr(historique.hisDate))
//                    }

                }
                
            }
            
        }
    }
}

struct HistoricalList_Previews: PreviewProvider {
    static let api = Api()
    
    static var previews: some View {
        HistoricalList(utilisateur: api.utilisateurs[1])
            .environmentObject(api)
    }
}
