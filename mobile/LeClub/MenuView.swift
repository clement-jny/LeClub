//
//  MenuView.swift
//  LeClub
//
//  Created by Clément Jaunay on 31/03/2022.
//

import SwiftUI

struct MenuView: View {
    @State private var selection: Tab = .utilisateur
    
    enum Tab {
        case utilisateur, sport, session, role
    }
    
    var body: some View {
        TabView(selection: $selection) {
            UserList()
                .tabItem {
                    Label("Utilisateurs", systemImage: "person.3")
                }
                .tag(Tab.utilisateur)
            
            SportList()
                .tabItem {
                    Label("Sports", systemImage: "sportscourt")
                }
                .tag(Tab.sport)
            
            SessionList()
                .tabItem {
                    Label("Sessions", systemImage: "doc.on.clipboard")
                }
                .tag(Tab.session)
            
            RoleList()
                .tabItem {
                    Label("Roles", systemImage: "questionmark")
                    //person.fill.questionmark
                }
                .tag(Tab.role)
        }
    }
}

struct MenuView_Previews: PreviewProvider {
    static var previews: some View {
        MenuView()
            .environmentObject(Api())
    }
}


