//
//  TestView.swift
//  LeClub
//
//  Created by Clément Jaunay on 29/03/2022.
//

import SwiftUI

struct TestView: View {
    
    @State var models: [Utilisateur] = []
    
    var body: some View {
        
        //}
        //.onAppear {
            //send request to server
//            guard let url = URL(string: "http://localhost/leclub/api/utilisateurs") else {
//                print("invalid url")
//                return
//            }
            
//            var urlRequest: URLRequest = URLRequest(url: url)
//            urlRequest.httpMethod = "GET"
//            URLSession.shared.dataTask(with: urlRequest) { data, response, error in
//                //check if response is okay
//                guard let data = data else {
//                    print("invalid response")
//                    return
//                }
//
//                //convert json response into class model as an aray
//                do {
//                    self.models = try JSONDecoder().decode([Utilisateur].self, from: data)
//                } catch {
//                    print(error.localizedDescription)
//                }
//
//            }.resume()
        //}
        Text("hello")
    }
}

//create model class
//class ResponseModel: Codable, Identifiable {
//    let uti_id: String
//    let uti_nom: String
//    let uti_prenom: String
//    let uti_mail: String
//    let uti_mdp: String
//    let uti_role: String
//}

struct TestView_Previews: PreviewProvider {
    static var previews: some View {
        TestView()
    }
}
