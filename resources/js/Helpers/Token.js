class Token{

    isValid(token){
        const payload = this.payload(token);
        if (payload) {
            return payload.iss == "http://localhost:8000/api/auth/login" || "http:localhost:8000/api/auth/register" ? true : false // Check request get from which link
        }
        return false;
    }

    payload(token){
        const payload = token.split('.')[1];		//split from . and then decode and get name/id
        return this.decode(payload);
    }


    decode(payload){
        return JSON.parse(atob(payload));			//VERIFY SIGNATURE atob() is encode-decode Base64
    }
}

export default Token = new Token()
