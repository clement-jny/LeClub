//
//  AddSession.swift
//  LeClub
//
//  Created by Clément Jaunay on 01/04/2022.
//

import SwiftUI

struct AddSession: View {
    @EnvironmentObject var api: Api
    @Binding var addSession: Bool
    
    @State private var date = ""
    @State private var heure = ""
    @State private var sport = 1
    
    var body: some View {
        Form {
            HStack {
                Text("Date")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                DatePicker("", selection: .constant(Date()), displayedComponents: .date)
            }
            
            HStack {
                Text("Heure")
                    .bold()
                    .frame(width: 75, alignment: .leading)
                Divider()
                DatePicker("", selection: .constant(Date()), displayedComponents: .hourAndMinute)
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
                        //ajouter
                        await api.addSession(date: date, heure: heure, sport: sport)
                        self.addSession = false
                    }
                } label: {
                    Text("Valider")
                }
            }
        }
    }
}

struct AddSession_Previews: PreviewProvider {
    static var previews: some View {
        AddSession(addSession: .constant(true))
            .environmentObject(Api())
    }
}
