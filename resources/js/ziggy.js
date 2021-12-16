const Ziggy = {"url":"http:\/\/127.0.0.1:8000","port":8000,"defaults":{},"routes":{"login":{"uri":"login","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.update":{"uri":"reset-password","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"user-profile-information.update":{"uri":"user\/profile-information","methods":["PUT"]},"user-password.update":{"uri":"user\/password","methods":["PUT"]},"password.confirm":{"uri":"user\/confirm-password","methods":["GET","HEAD"]},"password.confirmation":{"uri":"user\/confirmed-password-status","methods":["GET","HEAD"]},"two-factor.login":{"uri":"two-factor-challenge","methods":["GET","HEAD"]},"two-factor.enable":{"uri":"user\/two-factor-authentication","methods":["POST"]},"two-factor.disable":{"uri":"user\/two-factor-authentication","methods":["DELETE"]},"two-factor.qr-code":{"uri":"user\/two-factor-qr-code","methods":["GET","HEAD"]},"two-factor.recovery-codes":{"uri":"user\/two-factor-recovery-codes","methods":["GET","HEAD"]},"profile.show":{"uri":"user\/profile","methods":["GET","HEAD"]},"other-browser-sessions.destroy":{"uri":"user\/other-browser-sessions","methods":["DELETE"]},"current-user-photo.destroy":{"uri":"user\/profile-photo","methods":["DELETE"]},"current-user.destroy":{"uri":"user","methods":["DELETE"]},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"settings.create":{"uri":"dashboard\/settings","methods":["GET","HEAD"]},"settings.save-hero":{"uri":"dashboard\/settings\/save-hero","methods":["POST"]},"settings.save-about":{"uri":"dashboard\/settings\/save-about","methods":["POST"]},"settings.save-contact":{"uri":"dashboard\/settings\/save-contact","methods":["POST"]},"categories.index":{"uri":"dashboard\/categories","methods":["GET","HEAD"]},"categories.create":{"uri":"dashboard\/categories\/create","methods":["GET","HEAD"]},"categories.store":{"uri":"dashboard\/categories","methods":["POST"]},"categories.show":{"uri":"dashboard\/categories\/{category}","methods":["GET","HEAD"]},"categories.edit":{"uri":"dashboard\/categories\/{category}\/edit","methods":["GET","HEAD"],"bindings":{"category":"id"}},"categories.update":{"uri":"dashboard\/categories\/{category}","methods":["PUT","PATCH"],"bindings":{"category":"id"}},"categories.destroy":{"uri":"dashboard\/categories\/{category}","methods":["DELETE"],"bindings":{"category":"id"}},"articles.index":{"uri":"dashboard\/articles","methods":["GET","HEAD"]},"articles.create":{"uri":"dashboard\/articles\/create","methods":["GET","HEAD"]},"articles.store":{"uri":"dashboard\/articles","methods":["POST"]},"articles.show":{"uri":"dashboard\/articles\/{article}","methods":["GET","HEAD"]},"articles.edit":{"uri":"dashboard\/articles\/{article}\/edit","methods":["GET","HEAD"],"bindings":{"article":"id"}},"articles.update":{"uri":"dashboard\/articles\/{article}","methods":["PUT","PATCH"],"bindings":{"article":"id"}},"articles.destroy":{"uri":"dashboard\/articles\/{article}","methods":["DELETE"],"bindings":{"article":"id"}}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
