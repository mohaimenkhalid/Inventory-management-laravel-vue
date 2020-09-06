import Token from './Token.js'
import AppStorage from './AppStorage.js'

class User{

    responseAfterLogin(res){
        const access_token = res.data.access_token;
        const username = res.data.name;

        if (Token.isValid(access_token)) {  //check token is it valid or not
            AppStorage.store(access_token, username); //if valid store data
        }
    }

    hasToken(){
        const storeToken = localStorage.getItem("token"); //get token from localstorage
        if (storeToken) {										//if get
            return Token.isValid(storeToken) ? true : false   	//then check valid or not
        }
        return false;
    }


    loggedIn(){
        return this.hasToken();  //if return token in storage
    }

    /*loggedOut(){
        AppStorage.clear(); //clear localstorage
        window.location= '/';
    }*/

    name(){
        if (this.loggedIn()) {    //if logged
            return AppStorage.getUser(); 	//then get username
        }
    }


    id(){
        if (this.loggedIn()) {
            const payload = Token.payload(AppStorage.getToken());  //it get data from token payload from storage token
            return payload.sub; //sub = user id
        }
        return false;
    }

}

export default User = new User();
