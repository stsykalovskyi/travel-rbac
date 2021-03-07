package com.stsykalovskyi.travelrbac;

import com.stsykalovskyi.travelrbac.models.RbacUserDetails;
import com.stsykalovskyi.travelrbac.models.User;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class RbacUserDetailsService implements UserDetailsService {
    @Autowired
    UserRepository userRepository;

    @Override
    public UserDetails loadUserByUsername(String username) throws UsernameNotFoundException {
        Optional<User> user = userRepository.findByUsername(username);

        user.orElseThrow(() -> new UsernameNotFoundException("Not found: " + username));

        return user.map(RbacUserDetails::new).get();
    }
}
