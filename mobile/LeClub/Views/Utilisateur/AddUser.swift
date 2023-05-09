//
//  AddUser.swift
//  LeClub
//
//  Created by Clément Jaunay on 31/03/2022.
//

import SwiftUI

struct AddUser: View {
    @EnvironmentObject var api: Api
    @Binding var addUser: Bool
    
    @State private var nom = ""
    @State private var prenom = ""
    @State private var mail = ""
    @State private var mdp = ""
    
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
                Text("Mdp")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                TextField("Mdp", text: $mdp)
            }
            
            HStack {
                Button {
                    Task {
                        //ajout
                        await api.addUtilisateur(nom: nom, prenom: prenom, mail: mail, mdp: mdp)
                        self.addUser = false
                    }
                } label: {
                    Text("Valider")
                }

            }
        }
    }
}

struct AddUser_Previews: PreviewProvider {
    static var previews: some View {
        AddUser(addUser: .constant(true))
            .environmentObject(Api())
    }
}
