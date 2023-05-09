//
//  UserDetail.swift
//  LeClub
//
//  Created by Clément Jaunay on 30/03/2022.
//

import SwiftUI

struct UserDetail: View {
    @EnvironmentObject var api: Api
    @Environment(\.dismiss) var dismiss
    
    var utilisateur: Utilisateur
    
    @State private var showAlert = false
    @State private var showConfirmation = false
    
    @State private var nom = ""
    @State private var prenom = ""
    @State private var mail = ""
    @State private var role = 0
    
    var body: some View {
        Form {
            HStack {
                Text("Nom")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                TextField("Nom", text: $nom)
            }
            
            HStack {
                Text("Prénom")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                TextField("Prénom", text: $prenom)
            }
            
            HStack {
                Text("Mail")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                TextField("Mail", text: $mail)
            }
            
            HStack {
                Text("Rôle")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                Spacer()
                Picker("Sport", selection: $role) {
                    ForEach(api.roles, id:\.rolID) { rol in
                        Text(rol.rolLibelle).tag(rol.rolID)
                    }
                }
                .pickerStyle(.menu)
            }

            HStack {
                
                Button {
                    Task {
                        //modifier
                        await api.updateUtilisateur(id: utilisateur.utiID, nom: nom, prenom: prenom, mail: mail, role: role)
                        self.showConfirmation.toggle()
                    }
                } label: {
                    Text("Valider")
                }
            }
            
            Section("Historique") {
                HistoricalList(utilisateur: utilisateur)
            }
        }
        .navigationTitle("\(utilisateur.utiID) - \(utilisateur.utiNom) \(utilisateur.utiPrenom)")
        .navigationBarTitleDisplayMode(.inline)
        .toolbar {
            Button {
                self.showAlert.toggle()
            } label: {
                Label("Supprimer utilisateur", systemImage: "trash")
                    .foregroundColor(.red)
            }
        }
        .alert("Êtes vous sûr de vouloir supprimer cet utilisateur ?", isPresented: $showAlert) {
            Button("Valider", role: .destructive) {
                Task {
                    //supp
                    await api.deleteUtilisateur(id: utilisateur.utiID)
                    self.showAlert = false
                }
            }
            Button("Annuler", role: .cancel) { }
        }
        .alert(api.resultat.message, isPresented: $showConfirmation) {
            Button("OK", role: .cancel) {
                dismiss()
            }
        }
        .onAppear {
            self.nom = self.utilisateur.utiNom
            self.prenom = self.utilisateur.utiPrenom
            self.mail = self.utilisateur.utiMail
            self.role = self.utilisateur.utiRole
        }
    }
}

struct UserDetail_Previews: PreviewProvider {
    static let api = Api()
    
    static var previews: some View {
        UserDetail(utilisateur: api.utilisateurs[1])
            .environmentObject(api)
    }
}
