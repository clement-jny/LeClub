//
//  Date+Extension.swift
//  LeClub
//
//  Created by Clément Jaunay on 01/04/2022.
//

import Foundation

extension Date {
    func convertDateToFr(_ dateString: String) -> String {
        let formatterGet = DateFormatter()
        formatterGet.dateFormat = "yyyy-MM-dd"
        
        let formatterPrint = DateFormatter()
        formatterPrint.dateFormat = "dd/MM/yyyy"
        
        if let date = formatterGet.date(from: dateString) {
            return formatterPrint.string(from: date)
        } else {
            return "Erreur convertion date"
        }
    }
    
    func convertDateTimeToFr(_ dateString: String) -> String {
        let formatterGet = DateFormatter()
        formatterGet.dateFormat = "yyyy-MM-dd hh:mm:ss"
        
        let formatterPrint = DateFormatter()
        formatterPrint.dateFormat = "dd/MM/yyyy hh:mm:ss"
        
        if let date = formatterGet.date(from: dateString) {
            return formatterPrint.string(from: date)
        } else {
            return "Erreur convertion date"
        }
    }
    
//    func convertStringToDate(_ dateString: String) -> Date {
//        let formatterGet = DateFormatter()
//        formatterGet.dateFormat = "yyyy-MM-dd"
//        formatterGet.dateStyle = .short
//        formatterGet.timeStyle = .none
//        
//        let formatterPrint = DateFormatter()
//        formatterPrint.dateFormat = "yyyy-MM-dd"
//        
//
////        let formatter = DateFormatter()
////        formatter.dateFormat = "dd/MM/yyyy"
//        
////        let formatterPrint = DateFormatter()
////        formatterPrint.dateFormat = "dd/MM/yyyy"
//        
//        
//        
//        
//        //return formatter.date(from: dateString) ?? Date.now
//    }
    
//    func convertDateToString(_ date: Date) -> String {
//        let formatterGet = DateFormatter()
//        formatterGet.dateFormat = "dd/MM/yyyy"
//        
//        let formatterPrint = DateFormatter()
//        formatterPrint.dateFormat = "yyyy-MM-dd"
//        
//        if let date = formatterGet.string(from: date) {
//            return formatterPrint.date(from: date)
//        } else {
//            return "Erreur convertion date"
//        }
//    }
}
