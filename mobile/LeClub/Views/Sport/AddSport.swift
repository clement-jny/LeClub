//
//  AddSport.swift
//  LeClub
//
//  Created by Clément Jaunay on 01/04/2022.
//

import SwiftUI

struct AddSport: View {
    @EnvironmentObject var api: Api
    @Binding var addSport: Bool
    
    @State private var libelle = ""
    @State private var nbMax = 1
    
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
                Text("Nombre max")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                Stepper(value: $nbMax, in: 1...30) {
                    Text("\(nbMax)")
                }
            }
            
            HStack {
                Button {
                    Task {
                        //ajout
                        await api.addSport(libelle: libelle, nbMax: nbMax)
                        self.addSport = false
                    }
                } label: {
                    Text("Valider")
                }
            }
        }
    }
}

struct AddSport_Previews: PreviewProvider {
    static var previews: some View {
        AddSport(addSport: .constant(true))
            .environmentObject(Api())
    }
}
