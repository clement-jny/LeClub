//
//  TestView.swift
//  LeClub
//
//  Created by Clément Jaunay on 29/03/2022.
//

import SwiftUI

struct TestView: View {
    @EnvironmentObject var api: Api
    
    var body: some View {
        NavigationView {
//            List {
//                ForEach(modelData.utilisateurs, id: \.utiID) { uti in
//                    Text("Id : \(uti.utiID), \(uti.utiNom), \(uti.utiPrenom)")
//                }
//
//            }
//            .navigationTitle("Les utilisateurs - admin")
//            .onAppear {
//                modelData.fetchData()
            
            //}
            
            List {
                
                Section("Historiques") {
                    VStack(alignment: .leading) {
                        ForEach(api.historiques, id: \.hisSession) { historique in
                            HStack(alignment: .top) {
                                Text(historique.hisDate)
                                
                                VStack(alignment: .leading) {
                                    Text("\(historique.hisUtilisateur)")
                                        .bold()
                                    
                                         Text("\(historique.hisSession)")
                                }
                            }
                            .frame(width: 300, alignment: .leading)
                            .padding()
                        }
                    }
                }
                
                Section("Roles") {
                    VStack(alignment: .leading) {
                        ForEach(api.roles, id: \.rolID) { role in
                            HStack(alignment: .top) {
                                Text("\(role.rolID)")
                                
                                VStack(alignment: .leading) {
                                    Text(role.rolLibelle)
                                        .bold()
                                }
                            }
                            .frame(width: 300, alignment: .leading)
                            .padding()
                        }
                    }
                }
                
                Section("Sessions") {
                    VStack(alignment: .leading) {
                        ForEach(api.sessions, id: \.sesID) { session in
                            HStack(alignment: .top) {
                                Text("\(session.sesID)")
                                
                                VStack(alignment: .leading) {
                                    Text("\(session.sesDate) - \(session.sesHeure)")
                                        .bold()
                                    
                                    Text("\(session.sesSport)")
                                }
                            }
                            .frame(width: 300, alignment: .leading)
                            .padding()
                        }
                    }
                }
                
                Section("Sports") {
                    VStack(alignment: .leading) {
                        ForEach(api.sports, id: \.spoID) { sport in
                            HStack(alignment: .top) {
                                Text("\(sport.spoID)")
                                
                                VStack(alignment: .leading) {
                                    Text(sport.spoLibelle)
                                        .bold()
                                    
                                    Text("\(sport.spoNbmax)")
                                }
                            }
                            .frame(width: 300, alignment: .leading)
                            .padding()
                        }
                    }
                }
                
                Section("Utilisateurs") {
                    VStack(alignment: .leading) {
                        ForEach(api.utilisateurs, id: \.utiID) { utilisateur in
                            HStack(alignment: .top) {
                                Text("\(utilisateur.utiID)")
                                
                                VStack(alignment: .leading) {
                                    Text(utilisateur.utiNom)
                                        .bold()
                                    
                                    Text(utilisateur.utiPrenom)
                                    
                                    Text(utilisateur.utiMail.lowercased())
                                }
                            }
                            .frame(width: 300, alignment: .leading)
                            .padding()
                        }
                    }
                }
            }
            .listStyle(.sidebar)
            .task {
                await api.loadHistoriques()
                await api.loadRoles()
                await api.loadSessions()
                await api.loadSports()
                await api.loadUtilisateurs()
            }
        
        }
    }
}

struct TestView_Previews: PreviewProvider {
    static var previews: some View {
        TestView()
            .environmentObject(Api())
    }
}
