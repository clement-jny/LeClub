//
//  LoginView.swift
//  LeClub
//
//  Created by Clément Jaunay on 31/03/2022.
//

import SwiftUI

struct LoginView: View {
    @State private var mail: String = ""
    @State private var mdp: String = ""
    
    var body: some View {
        VStack {
            Text("Veuillez vous connecter.")
            
            HStack {
                Text("Mail")
                TextField("Mail", text: $mail)
            }
            HStack {
                Text("Mdp")
                SecureField("Mdp", text: $mdp)
            }
            
            Button {
                //showModal.toggle()
            } label: {
                Label {
                    Text("Se connecter")
                } icon: {
                    Image(systemName: "lock")
                }
            }
        }
    }
}

struct LoginView_Previews: PreviewProvider {
    static var previews: some View {
        LoginView()
    }
}
