//
//  ContentView.swift
//  LeClub
//
//  Created by Clément Jaunay on 29/03/2022.
//

import SwiftUI

//struct Utilisateur: Hashable, Codable {
//    let uti_id: String
//    let uti_nom: String
//    let uti_prenom: String
//    let uti_mail: String
//    let uti_mdp: String
//    let uti_role: String
//}

//class ViewModel: ObservableObject {
    //@Published var utilisateurs: [Utilisateur] = []
    
//    func fetch() {
//        guard let url = URL(string: "http://localhost/leclub/api/utilisateurs") else {
//            return
//        }
//
//        let task = URLSession.shared.dataTask(with: url) { [weak self] data, _, error in
//            guard let data = data, error == nil else {
//                return
//            }
//
//            //convert to json
//            do {
//                let utilisateurs = try  JSONDecoder().decode([Utilisateur].self, from: data)
//                DispatchQueue.main.async {
//                    self?.utilisateurs = utilisateurs
//                }
//            }
//            catch {
//                print(error)
//            }
//        }
//
//        task.resume()
//    }
//}

struct ContentView: View {
    //@StateObject var viewModel = ViewModel()
    
    var body: some View {
        NavigationView {
            List {
//                ForEach(viewModel.utilisateurs) { utilisateur in
                    HStack {
                        Text("hello")
//                        Text(utilisateur.nom)
//                            .bold()
//                        Text(utilisateur.uti_prenom)
//                            .bold()
                    }
                    .padding(3)
                //}
            }
            .navigationTitle("Utilisateurs")
//            .onAppear {
//                viewModel.fetch()
//            }
        }
    }
}

struct ContentView_Previews: PreviewProvider {
    static var previews: some View {
        ContentView()
    }
}
