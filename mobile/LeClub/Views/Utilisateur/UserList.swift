//
//  UserList.swift
//  LeClub
//
//  Created by Clément Jaunay on 29/03/2022.
//

import SwiftUI

struct UserList: View {
    @EnvironmentObject var api: Api
    @State private var addUser : Bool = false
    //@State private var isActive: Int? = nil
    
    var body: some View {
        NavigationView {
            List {
                
                ForEach(api.roles, id:\.rolID) { role in
                    Section(role.rolLibelle) {
                        
                        ForEach(api.utilisateurs, id:\.utiID) { utilisateur in
                            if role.rolID == utilisateur.utiRole {
                                NavigationLink {
                                    UserDetail(utilisateur: utilisateur)
                                        .environmentObject(api)
                                } label: {
                                    Label("\(utilisateur.utiNom) \(utilisateur.utiPrenom)", systemImage: "person")
                                }
                            }
                        }
                        
                    }
                }
                
            }
            .navigationBarTitle("Utilisateurs")
            //.listStyle(.sidebar)
            .toolbar {
                Button {
                    addUser.toggle()
                } label: {
                    Label("Ajouter utilisateur", systemImage: "person.badge.plus")
                }
            }
            .sheet(isPresented: $addUser) {
                AddUser(addUser: $addUser)
                    .environmentObject(api)
            }
        }
    }
}

struct UserList_Previews: PreviewProvider {
    static var previews: some View {
        UserList()
            .environmentObject(Api())
    }
}
