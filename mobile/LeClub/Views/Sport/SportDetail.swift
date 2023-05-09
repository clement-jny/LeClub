//
//  SportDetail.swift
//  LeClub
//
//  Created by Clément Jaunay on 31/03/2022.
//

import SwiftUI

struct SportDetail: View {
    @EnvironmentObject var api: Api
    @Environment(\.dismiss) var dismiss
    
    var sport: Sport
    
    @State private var showAlert = false
    
    @State private var libelle = ""
    @State private var nbMax = 0
    
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
                        //modifer
                        await api.updateSport(id: sport.spoID,libelle: libelle, nbMax: nbMax)
                        dismiss()
                    }
                } label: {
                    Text("Valider")
                }
            }
        }
        .navigationTitle("\(sport.spoID) - " + sport.spoLibelle)
        .navigationBarTitleDisplayMode(.inline)
        .toolbar {
            Button {
                self.showAlert.toggle()
            } label: {
                Label("Supprimer sport", systemImage: "trash")
                    .foregroundColor(.red)
            }
        }
        .alert("Êtes vous sûr de vouloir supprimer ce sport ?", isPresented: $showAlert) {
            Button("Valider", role: .destructive) {
                Task {
                    //supp
                    await api.deleteSport(id: sport.spoID)
                }
            }
            Button("Annuler", role: .cancel) { }
        }
        .onAppear {
            self.libelle = self.sport.spoLibelle
            self.nbMax = self.sport.spoNbmax
        }
    }
}

struct SportDetail_Previews: PreviewProvider {
    static let api = Api()
    
    static var previews: some View {
        SportDetail(sport: api.sports[0])
            .environmentObject(api)
    }
}
