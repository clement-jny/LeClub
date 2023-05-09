//
//  AddRole.swift
//  LeClub
//
//  Created by Clément Jaunay on 01/04/2022.
//

import SwiftUI

struct AddRole: View {
    @EnvironmentObject var api: Api
    @Binding var addRole: Bool
    
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
                        //ajouter
                        await api.addRole(libelle: libelle)
                        self.addRole = false
                    }
                } label: {
                    Text("Valider")
                }
            }
        }
    }
}

struct AddRole_Previews: PreviewProvider {
    static var previews: some View {
        AddRole(addRole: .constant(true))
            .environmentObject(Api())
    }
}
