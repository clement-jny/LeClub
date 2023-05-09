//
//  SessionList.swift
//  LeClub
//
//  Created by Clément Jaunay on 31/03/2022.
//

import SwiftUI

struct SessionList: View {
    @EnvironmentObject var api: Api
    @State private var addSession = false
    
    var body: some View {
        NavigationView {
            List {
                
                ForEach(api.sports, id:\.spoID) { sport in
                    Section(sport.spoLibelle) {
                        
                        ForEach(api.sessions, id:\.sesID) { session in
                            if sport.spoID == session.sesSport {
                                NavigationLink {
                                    SessionDetail(session: session)
                                        .environmentObject(api)
                                } label: {
                                    Text(Date().convertDateToFr(session.sesDate) + " - " + session.sesHeure)
                                }
                            }
                        }
                        
                    }
                }
                
            }
            .navigationBarTitle("Sessions")
            //.listStyle(.sidebar)
            .toolbar {
                Button {
                    addSession.toggle()
                } label: {
                    Label("Ajouter session", systemImage: "plus")
                }
            }
            .sheet(isPresented: $addSession) {
                AddSession(addSession: $addSession)
                    .environmentObject(api)
            }
        }
    }
}

struct SessionList_Previews: PreviewProvider {
    static var previews: some View {
        SessionList()
            .environmentObject(Api())
    }
}
