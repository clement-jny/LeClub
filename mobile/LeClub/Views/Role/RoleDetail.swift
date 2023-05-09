//
//  RoleDetail.swift
//  LeClub
//
//  Created by Clément Jaunay on 31/03/2022.
//

import SwiftUI

struct RoleDetail: View {
    @EnvironmentObject var api: Api
    @Environment(\.dismiss) var dismiss
    
    var role: Role
    
    @State private var showAlert = false
    
    @State private var libelle = ""
    
    var body: some View {
        Form {
            HStack {
                Text("Libelle")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                TextField("Libelle", text: $libelle)
            }
            
            HStack {
                Button {
                    Task {
                        //modifier
                        await api.updateRole(id: role.rolID, libelle: libelle)
                        dismiss()
                    }
                } label: {
                    Text("Valider")
                }
            }
        }
        .navigationTitle("\(role.rolID) - " + role.rolLibelle)
        .navigationBarTitleDisplayMode(.inline)
        .toolbar {
            Button {
                self.showAlert.toggle()
            } label: {
                Label("Supprimer rôle", systemImage: "trash")
                    .foregroundColor(.red)
            }
        }
        .alert("Êtes vous sûr de vouloi supprimer ce rôle ?", isPresented: $showAlert) {
            Button("Valider", role: .destructive) {
                Task {
                    //supp
                    await api.deleteRole(id: role.rolID)
                }
            }
            Button("Annuler", role: .cancel) { }
        }
        .onAppear {
            self.libelle = self.role.rolLibelle
        }
    }
}

struct RoleDetail_Previews: PreviewProvider {
    static let api = Api()
    
    static var previews: some View {
        RoleDetail(role: api.roles[0])
            .environmentObject(api)
    }
}
