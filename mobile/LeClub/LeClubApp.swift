//
//  LeClubApp.swift
//  LeClub
//
//  Created by Clément Jaunay on 29/03/2022.
//

import SwiftUI

@main
struct LeClubApp: App {
    @StateObject private var api = Api()
    
    var body: some Scene {
        WindowGroup {
            MenuView()
                .environmentObject(api)
                .task {
                    await api.loadHistoriques()
                    await api.loadRoles()
                    await api.loadSessions()
                    await api.loadSports()
                    await api.loadUtilisateurs()
                }
        }
    }
}
