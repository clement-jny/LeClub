//
//  MenuView.swift
//  LeClub
//
//  Created by Clément Jaunay on 30/03/2022.
//

import SwiftUI

struct MenuView: View {
    
    
    
    var body: some View {
        Text("menu")
    }
}

struct MenuView_Previews: PreviewProvider {
    static var previews: some View {
        MenuView()
            .environmentObject(Api())
    }
}
