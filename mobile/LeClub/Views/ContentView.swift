//
//  MenuView.swift
//  LeClub
//
//  Created by Clément Jaunay on 30/03/2022.
//

import SwiftUI

struct MenuView: View {
    @State private var selection: Tab = .utilisateur
    
    enum Tab {
        case utilisateur, sport
    }
    
    var body: some View {
        TabView(selection: $selection) {
            UtilisateurList()
                .tabItem {
                    Label("Utilisateur", systemImage: "person")

                }
                .tag(Tab.utilisateur)
            
            SportList()
                .tabItem {
                    Label("Sport", systemImage: "sportscourt")
                }
                .tag(Tab.sport)
        }
    }
}

struct MenuView_Previews: PreviewProvider {
    static var previews: some View {
        MenuView()
            .environmentObject(Api())
    }
}
