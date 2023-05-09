//
//  RoleList.swift
//  LeClub
//
//  Created by Clément Jaunay on 31/03/2022.
//

import SwiftUI

struct RoleList: View {
    @EnvironmentObject var api: Api
    @State private var addRole = false
    
    var body: some View {
        NavigationView {
            List {
                ForEach(api.roles, id: \.rolID) { role in
                    NavigationLink(role.rolLibelle) {
                        RoleDetail(role: role)
                            .environmentObject(api)
                    }
                }
            }
            .navigationBarTitle("Rôles")
            .toolbar {
                Button {
                    addRole.toggle()
                } label: {
                    Label("Ajouter rôle", systemImage: "plus")
                }
            }
            .sheet(isPresented: $addRole) {
                AddRole(addRole: $addRole)
                    .environmentObject(api)
            }
        }
    }
}

struct RoleList_Previews: PreviewProvider {
    static var previews: some View {
        RoleList()
            .environmentObject(Api())
    }
}
