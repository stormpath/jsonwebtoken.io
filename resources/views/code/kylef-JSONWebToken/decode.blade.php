import JWT

do {
    let payload = try JWT.decode("{{$request['jwt']['token']}}", algorithm: .HS256("{{$request['jwt']['key']}}"))
    print(payload)
} catch {
    print("Failed to decode JWT: \(error)")
}