//
//  SessionDetail.swift
//  LeClub
//
//  Created by Clément Jaunay on 31/03/2022.
//

import SwiftUI

struct SessionDetail: View {
    @EnvironmentObject var api: Api
    @Environment(\.dismiss) var dismiss
    
    var session: Session
    
    @State private var showAlert = false
    
    @State private var date = Date.now
    @State private var heure = Date.now
    
    @State private var test = Date()
    @State private var sport = 0
    
    
    var body: some View {
        Form {
            HStack {
                Text("Date")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                DatePicker("", selection: $date, displayedComponents: .date)
                    .environment(\.locale, Locale(identifier: "fr_FR"))
            }
            
            HStack {
                Text("Heure")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                DatePicker("", selection: $heure, displayedComponents: .hourAndMinute)
                    .environment(\.locale, Locale(identifier: "fr_FR"))
            }
            
            HStack {
                Text("Sport")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                Spacer()
                Picker("Sport", selection: $sport) {
                    ForEach(api.sports, id:\.spoID) { spo in
                        Text(spo.spoLibelle).tag(spo.spoID)
                    }
                }
                .pickerStyle(.menu)
            }
            
            HStack {
                Button {
                    Task {
                        //modifier
                        //await api.updateSession(id: session.sesID, date: date, heure: heure, sport: sport)
                        dismiss()
                    }
                } label: {
                    Text("Valider")
                }
            }
        }
        .navigationTitle("\(session.sesID) - " + Date().convertDateToFr(session.sesDate))
        .navigationBarTitleDisplayMode(.inline)
        .toolbar {
            Button {
                self.showAlert.toggle()
            } label: {
                Label("Supprimer session", systemImage: "trash")
                    .foregroundColor(.red)
            }
        }
        .alert("Êtes vous sûr de vouloir supprimer cette session ?", isPresented: $showAlert) {
            Button("Valider", role: .destructive) {
                Task {
                    //supp
                    await api.deleteSession(id: session.sesID)
                }
            }
            Button("Annuler", role: .cancel) { }
        }
        .onAppear {
            //self.date = self.session.sesDate
            //self.heure = self.session.sesHeure
            self.sport = self.session.sesSport
        }
    }
}

struct SessionDetail_Previews: PreviewProvider {
    static let api = Api()
    
    static var previews: some View {
        SessionDetail(session: api.sessions[0])
            .environmentObject(api)
    }
}
