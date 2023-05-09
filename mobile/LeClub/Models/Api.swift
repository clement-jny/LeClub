//
//  Api.swift
//  LeClub
//
//  Created by Clément Jaunay on 30/03/2022.
//

import Foundation
import SwiftUI


class Api: ObservableObject {
//    static let shared = Api()
//    private init() {}
    
    //@Published var resultat:
    @Published var resultat: Resultat = Resultat.empty
    @Published var historiques: [Historique] = []
    @Published var roles: [Role] = []
    @Published var sessions: [Session] = []
    @Published var sports: [Sport] = []
    @Published var utilisateurs: [Utilisateur] = []
    
    private var urlString = "http://localhost/leclub/api/"
    
    private enum EndPoints: String, CaseIterable {
        case historiques, roles, sessions, sports, utilisateurs
    }
}


// MARK: - Historique
extension Api {
    func loadHistoriques() async {
        let endPoint: EndPoints = .historiques
        guard let url = URL(string: urlString + endPoint.rawValue) else {
            print("Invalid URL")
            return
        }
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "GET"
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }
            
            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode([Historique].self, from: data)
                    
                    DispatchQueue.main.async {
                        self.historiques = decodedData
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }
        
        dataTask.resume()
    }
    
    func addHistorique(id_ses: Int, id_uti: Int, date: String) async {
        let endPoint: EndPoints = .utilisateurs
        guard let url = URL(string: urlString + endPoint.rawValue) else {
            print("Invalid URL")
            return
        }
        
        var components = URLComponents(url: url, resolvingAgainstBaseURL: false)!
        components.queryItems = [
            URLQueryItem(name: "his_session", value: String(id_ses)),
            URLQueryItem(name: "his_utilisateur", value: String(id_uti)),
            URLQueryItem(name: "his_date", value: date)
        ]
        
        let query = components.url!.query
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "POST"
        urlRequest.httpBody = Data(query!.utf8)
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }

            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 201 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadHistoriques()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }

        dataTask.resume()
    }
    
    func updateHistorique(id_ses: Int, id_uti: Int, date: String) async {
        let endPoint: EndPoints = .historiques
        guard let url = URL(string: urlString + endPoint.rawValue + "/" + String(id_ses) + "/" + String(id_uti)) else {
            print("Invalid URL")
            return
        }
        
        var components = URLComponents(url: url, resolvingAgainstBaseURL: false)!
        components.queryItems = [
            URLQueryItem(name: "his_date", value: date)
        ]
        
        let query = components.url!.query
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "POST"
        urlRequest.httpBody = Data(query!.utf8)
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }

            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadHistoriques()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }

        dataTask.resume()
    }
    
    func deleteHistorique(id_ses: Int, id_uti: Int) async {
        let endPoint: EndPoints = .historiques
        guard let url = URL(string: urlString + endPoint.rawValue + "/" + String(id_ses) + "/" + String(id_uti)) else {
            print("Invalid URL")
            return
        }
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "DELETE"
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }
            
            guard let response = response as? HTTPURLResponse else {
                return
            }
            
            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadHistoriques()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }
        
        dataTask.resume()
    }
}
    

// MARK: - Role
extension Api {
    func loadRoles() async {
        let endPoint: EndPoints = .roles
        guard let url = URL(string: urlString + endPoint.rawValue) else {
            print("Invalid URL")
            return
        }
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "GET"
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }
            
            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode([Role].self, from: data)
                    
                    DispatchQueue.main.async {
                        self.roles = decodedData
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }
        
        dataTask.resume()
    }
    
    func addRole(libelle: String) async {
        let endPoint: EndPoints = .roles
        guard let url = URL(string: urlString + endPoint.rawValue) else {
            print("Invalid URL")
            return
        }
        
        var components = URLComponents(url: url, resolvingAgainstBaseURL: false)!
        components.queryItems = [
            URLQueryItem(name: "rol_libelle", value: libelle)
        ]
        
        let query = components.url!.query
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "POST"
        urlRequest.httpBody = Data(query!.utf8)
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }

            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 201 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadRoles()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }

        dataTask.resume()
    }
    
    func updateRole(id: Int, libelle: String) async {
        let endPoint: EndPoints = .roles
        guard let url = URL(string: urlString + endPoint.rawValue + "/" + String(id)) else {
            print("Invalid URL")
            return
        }
        
        var components = URLComponents(url: url, resolvingAgainstBaseURL: false)!
        components.queryItems = [
            URLQueryItem(name: "rol_libelle", value: libelle)
        ]
        
        let query = components.url!.query
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "POST"
        urlRequest.httpBody = Data(query!.utf8)
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }

            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadRoles()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }

        dataTask.resume()
    }
    
    func deleteRole(id: Int) async {
        let endPoint: EndPoints = .roles
        guard let url = URL(string: urlString + endPoint.rawValue + "/" + String(id)) else {
            print("Invalid URL")
            return
        }
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "DELETE"
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }
            
            guard let response = response as? HTTPURLResponse else {
                return
            }
            
            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadRoles()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }
        
        dataTask.resume()
    }
}
    
    
// MARK: - Session
extension Api {
    func loadSessions() async {
        let endPoint: EndPoints = .sessions
        guard let url = URL(string: urlString + endPoint.rawValue) else {
            print("Invalid URL")
            return
        }
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "GET"
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }
            
            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode([Session].self, from: data)
                    
                    DispatchQueue.main.async {
                        self.sessions = decodedData
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }
        
        dataTask.resume()
    }
    
    func addSession(date: String, heure: String, sport: Int) async {
        let endPoint: EndPoints = .sessions
        guard let url = URL(string: urlString + endPoint.rawValue) else {
            print("Invalid URL")
            return
        }
        
        var components = URLComponents(url: url, resolvingAgainstBaseURL: false)!
        components.queryItems = [
            URLQueryItem(name: "ses_date", value: date),
            URLQueryItem(name: "ses_heure", value: heure),
            URLQueryItem(name: "ses_sport", value: String(sport))
        ]
        
        let query = components.url!.query
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "POST"
        urlRequest.httpBody = Data(query!.utf8)
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }

            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 201 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadSessions()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }

        dataTask.resume()
    }
    
    func updateSession(id: Int, date: String, heure: String, sport: Int) async {
        let endPoint: EndPoints = .sessions
        guard let url = URL(string: urlString + endPoint.rawValue + "/" + String(id)) else {
            print("Invalid URL")
            return
        }
        
        var components = URLComponents(url: url, resolvingAgainstBaseURL: false)!
        components.queryItems = [
            URLQueryItem(name: "ses_date", value: date),
            URLQueryItem(name: "ses_heure", value: heure),
            URLQueryItem(name: "ses_sport", value: String(sport))
        ]
        
        let query = components.url!.query
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "POST"
        urlRequest.httpBody = Data(query!.utf8)
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }

            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadSessions()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }

        dataTask.resume()
    }
    
    func deleteSession(id:Int) async {
        let endPoint: EndPoints = .sessions
        guard let url = URL(string: urlString + endPoint.rawValue + "/" + String(id)) else {
            print("Invalid URL")
            return
        }
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "DELETE"
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }
            
            guard let response = response as? HTTPURLResponse else {
                return
            }
            
            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadSessions()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }
        
        dataTask.resume()
    }
}

    
// MARK: - Sport
extension Api {
    func loadSports() async {
        let endPoint: EndPoints = .sports
        guard let url = URL(string: urlString + endPoint.rawValue) else {
            print("Invalid URL")
            return
        }
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "GET"
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }
            
            guard let response = response as? HTTPURLResponse else {
                return
            }
            
            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode([Sport].self, from: data)
                    
                    DispatchQueue.main.async {
                        self.sports = decodedData
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }
        
        dataTask.resume()
    }
    
    func addSport(libelle: String, nbMax: Int) async {
        let endPoint: EndPoints = .sports
        guard let url = URL(string: urlString + endPoint.rawValue) else {
            print("Invalid URL")
            return
        }
        
        var components = URLComponents(url: url, resolvingAgainstBaseURL: false)!
        components.queryItems = [
            URLQueryItem(name: "spo_libelle", value: libelle),
            URLQueryItem(name: "spo_nbmax", value: String(nbMax))
        ]
        
        let query = components.url!.query
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "POST"
        urlRequest.httpBody = Data(query!.utf8)

        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }

            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 201 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadSports()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }

        dataTask.resume()
    }
    
    func updateSport(id: Int, libelle: String, nbMax: Int) async {
        let endPoint: EndPoints = .sports
        guard let url = URL(string: urlString + endPoint.rawValue + "/" + String(id)) else {
            print("Invalid URL")
            return
        }
        
        var components = URLComponents(url: url, resolvingAgainstBaseURL: false)!
        components.queryItems = [
            URLQueryItem(name: "spo_libelle", value: libelle),
            URLQueryItem(name: "spo_nbmax", value: String(nbMax))
        ]
        
        let query = components.url!.query
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "POST"
        urlRequest.httpBody = Data(query!.utf8)
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }

            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadSports()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }

        dataTask.resume()
    }
    
    func deleteSport(id: Int) async {
        let endPoint: EndPoints = .sports
        guard let url = URL(string: urlString + endPoint.rawValue + "/" + String(id)) else {
            print("Invalid URL")
            return
        }
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "DELETE"
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }
            
            guard let response = response as? HTTPURLResponse else {
                return
            }
            
            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadSports()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }
        
        dataTask.resume()
    }
}
    
    
// MARK: - Utilisateur
extension Api {
    func loadUtilisateurs() async {
        let endPoint: EndPoints = .utilisateurs
        guard let url = URL(string: urlString + endPoint.rawValue) else {
            print("Invalid URL")
            return
        }
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "GET"
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }
            
            guard let response = response as? HTTPURLResponse else {
                return
            }
            
            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode([Utilisateur].self, from: data)
                    
                    DispatchQueue.main.async {
                        self.utilisateurs = decodedData
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }
        
        dataTask.resume()
    }
    
    func addUtilisateur(nom: String, prenom: String, mail: String, mdp: String) async {
        let endPoint: EndPoints = .utilisateurs
        guard let url = URL(string: urlString + endPoint.rawValue) else {
            print("Invalid URL")
            return
        }
        
        var components = URLComponents(url: url, resolvingAgainstBaseURL: false)!
        components.queryItems = [
            URLQueryItem(name: "uti_nom", value: nom),
            URLQueryItem(name: "uti_prenom", value: prenom),
            URLQueryItem(name: "uti_mail", value: mail),
            URLQueryItem(name: "uti_mdp", value: mdp)
        ]
        
        let query = components.url!.query
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "POST"
        urlRequest.httpBody = Data(query!.utf8)

        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }

            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 201 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadUtilisateurs()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }

        dataTask.resume()
    }
    
    func updateUtilisateur(id: Int, nom: String, prenom: String, mail: String, role: Int) async {
        let endPoint: EndPoints = .utilisateurs
        guard let url = URL(string: urlString + endPoint.rawValue + "/" + String(id)) else {
            print("Invalid URL")
            return
        }
        
        var components = URLComponents(url: url, resolvingAgainstBaseURL: false)!
        components.queryItems = [
            URLQueryItem(name: "uti_nom", value: nom),
            URLQueryItem(name: "uti_prenom", value: prenom),
            URLQueryItem(name: "uti_mail", value: mail),
            URLQueryItem(name: "uti_role", value: String(role))
        ]
        
        let query = components.url!.query
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "POST"
        urlRequest.httpBody = Data(query!.utf8)
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }

            guard let response = response as? HTTPURLResponse else {
                return
            }

            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        Task {
                            self.resultat = decodedData
                            await self.loadUtilisateurs()
                        }
                        //self.resultat = Resultat(code: decodedData.code, message: decodedData.message)
                        //print(decodedData)
                        //self.resultat = Resultat(code: decodedData.code, message: decodedData.message)
                        //print(self.resultat)
                        
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }

        dataTask.resume()
    }
    
    func deleteUtilisateur(id: Int) async {
        let endPoint: EndPoints = .utilisateurs
        guard let url = URL(string: urlString + endPoint.rawValue + "/" + String(id)) else {
            print("Invalid URL")
            return
        }
        
        var urlRequest = URLRequest(url: url)
        urlRequest.httpMethod = "DELETE"
        
        let dataTask = URLSession.shared.dataTask(with: urlRequest) { data, response, error in
            if let error = error {
                print("Request error : \(error)")
            }
            
            guard let response = response as? HTTPURLResponse else {
                return
            }
            
            if response.statusCode == 200 {
                guard let data = data else {
                    return
                }
                
                do {
                    let decoder = JSONDecoder()
                    let decodedData = try decoder.decode(Resultat.self, from: data)
                    
                    DispatchQueue.main.async {
                        print(decodedData)
                        
                        Task {
                            await self.loadUtilisateurs()
                        }
                    }
                } catch let error {
                    print("Error decoding : \(error)")
                }
            }
        }
        
        dataTask.resume()
    }
}
