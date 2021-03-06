var path = require('path');
var JS_DIR = path.resolve(__dirname, 'javascript');

module.exports = {
    entryPoints: {
      assignByFloor: JS_DIR + '/AssignByFloor/AssignByFloor.jsx',
      checkOut: JS_DIR + '/CheckOut/CheckOut.jsx',
      damageAssessment: JS_DIR + '/damageAssessment/DamageAssessment.jsx',
      rlcMembersList: JS_DIR + '/rlcMembersList/rlcMembersList.jsx',
      roomDamages: JS_DIR + '/RoomDamages/RoomDamages.jsx',
      studentRoomDamage: JS_DIR + '/StudentAddRoomDamages/roomDamage.jsx',
      emailLogView: JS_DIR + '/emailLogView/emailLogView.jsx',
      vendor: ['jquery', 'react', 'react-dom', 'react-bootstrap']
    }
}
