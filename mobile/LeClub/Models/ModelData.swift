//
//  ModelData.swift
//  LeClub
//
//  Created by Clément Jaunay on 29/03/2022.
//

import Foundation

class ModelData: ObservableObject {
    static let shared = ModelData()
    private init() {}
    
    @Published private(set) var historiques: [Historique] = []
    @Published private(set) var roles: [Role] = []
    @Published private(set) var sessions: [Session] = []
    @Published private(set) var sports: [Sport] = []
    @Published private(set) var utilisateurs: [Utilisateur] = []
    
    func fetchData() {
        let urlString = "http://localhost/leclub/api/"
        let endPoint = "utilisateurs"
        
        guard let url = URL(string: urlString + endPoint) else {
            print("Url invalide")
            return
        }

        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "GET"
        
        let task = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            guard let data = data else {
                print("erreur data")
                return
            }

            do {
                let decoder = JSONDecoder()
                
//                let hisDecoder = try decoder.decode([Historique].self, from: data)
//                let rolDecoder = try decoder.decode([Role].self, from: data)
//                let sesDecoder = try decoder.decode([Session].self, from: data)
//                let spoDecoder = try decoder.decode([Sport].self, from: data)
                let utiDecoder = try decoder.decode([Utilisateur].self, from: data)
                

                DispatchQueue.main.async {
//                    self.historiques = hisDecoder
//                    self.roles = rolDecoder
//                    self.sessions = sesDecoder
//                    self.sports = spoDecoder
                    self.utilisateurs = utiDecoder
                }
            } catch {
                print("Error : \(error)")
                print("Error localized : \(error.localizedDescription)")
            }

        }

        task.resume()
    }
}
