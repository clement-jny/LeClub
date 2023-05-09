//
//  SportList.swift
//  LeClub
//
//  Created by Clément Jaunay on 30/03/2022.
//

import SwiftUI

struct SportList: View {
    @EnvironmentObject var api: Api
    @State private var addSport = false
    
    var body: some View {
        NavigationView {
            List {
                ForEach(api.sports, id:\.spoID) { sport in
                    NavigationLink {
                        SportDetail(sport: sport)
                            .environmentObject(api)
                    } label: {
                        Label(sport.spoLibelle, image: sport.spoLibelle)
                    }

                }
            }
            .navigationBarTitle("Sports")
            .toolbar {
                Button {
                    addSport.toggle()
                } label: {
                    Label("Ajouter sport", systemImage: "plus")
                }
            }
            .sheet(isPresented: $addSport) {
                AddSport(addSport: $addSport)
                    .environmentObject(api)
            }
        }
    }
}

struct SportView_Previews: PreviewProvider {
    static var previews: some View {
        SportList()
            .environmentObject(Api())
    }
}
